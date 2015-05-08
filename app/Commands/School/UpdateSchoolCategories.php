<?php namespace UnifySchool\Commands\School;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Str;
use UnifySchool\Commands\Command;
use UnifySchool\Entities\School\ScopedSchoolCategoryArm;
use UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision;
use UnifySchool\School;

class UpdateSchoolCategories extends Command implements SelfHandling
{
    /**
     * @var array
     */
    private $school_categories;
    /**
     * @var School
     */
    private $school;

    /**
     * Create a new command instance.
     *
     * @param array $school_categories
     * @param School $school
     */
    public function __construct(array $school_categories, School $school)
    {
        //
        $this->school_categories = $school_categories;
        $this->school = $school;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        \DB::transaction(function () {
            foreach ($this->school_categories as $category) {
                $this->handleCategoryArms($category['school_category_arms'], $category['id']);
            }
        });
    }

    private function handleCategoryArms(array $school_category_arms, $id)
    {
        foreach ($school_category_arms as $arm) {
            $createdArm = $this->createCategoryArm($id, $arm['display_name']);

            if (isset($arm['has_arms']) && $arm['has_arms']) {
                $this->createCategoryArmSubdivisions($createdArm->id, $createdArm->display_name, $arm['arms']);
            } else {
                $this->createCategoryArmSubdivision($createdArm->id, $createdArm->display_name);
            }
        }
    }

    private function createCategoryArm($category_id, $arm_display_name)
    {
        $categoryArm = new ScopedSchoolCategoryArm();
        $categoryArm->scoped_school_category_id = $category_id;
        $categoryArm->name = Str::slug($arm_display_name);
        $categoryArm->display_name = $arm_display_name;
        $categoryArm->school_id = $this->school->id;
        $categoryArm->save();

        return $categoryArm;
    }

    private function createCategoryArmSubdivisions($id, $parent_name, $arms)
    {
        foreach ($arms as $arm) {
            $this->createCategoryArmSubdivision($id, $parent_name . ' ' . $arm['display_name']);
        }
    }

    private function createCategoryArmSubdivision($id, $display_name)
    {

        $categoryArm = ScopedSchoolCategoryArmSubdivision::firstOrNew(
            [
                'display_name'=> $display_name,
                'school_id' => $this->school->id,
                'scoped_school_category_arm_id' => $id
            ]);

        $categoryArm->name = Str::slug($display_name);

        $categoryArm->save();

        return $categoryArm;
    }

}
