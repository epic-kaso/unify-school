<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/25/2015
 * Time: 11:50 AM
 */

namespace UnifySchool\Services;


use UnifySchool\Entities\Context\SchoolContextTrait;
use UnifySchool\Repositories\School\ScopedBehaviourAssessmentSystemRepository;
use UnifySchool\Repositories\School\ScopedGradeAssessmentSystemsRepository;
use UnifySchool\Repositories\School\ScopedGradingSystemsRepository;
use UnifySchool\Repositories\School\ScopedSchoolClassRepository;
use UnifySchool\Repositories\School\ScopedSessionRepository;
use UnifySchool\School;

class SchoolSetupInfo {

    use SchoolContextTrait;
    /**
     * @var ScopedBehaviourAssessmentSystemRepository
     */
    private $behaviourAssessmentSystemRepository;
    /**
     * @var ScopedGradeAssessmentSystemsRepository
     */
    private $gradeAssessmentSystemsRepository;
    /**
     * @var ScopedGradingSystemsRepository
     */
    private $gradingSystemsRepository;
    /**
     * @var ScopedSessionRepository
     */
    private $scopedSessionRepository;
    /**
     * @var ScopedSchoolClassRepository
     */
    private $classRepository;

    function __construct(
        ScopedBehaviourAssessmentSystemRepository $behaviourAssessmentSystemRepository,
        ScopedGradeAssessmentSystemsRepository $gradeAssessmentSystemsRepository,
        ScopedGradingSystemsRepository $gradingSystemsRepository,
        ScopedSessionRepository $scopedSessionRepository,
        ScopedSchoolClassRepository $classRepository
    )
    {
        $this->behaviourAssessmentSystemRepository = $behaviourAssessmentSystemRepository;
        $this->gradeAssessmentSystemsRepository = $gradeAssessmentSystemsRepository;
        $this->gradingSystemsRepository = $gradingSystemsRepository;
        $this->scopedSessionRepository = $scopedSessionRepository;
        $this->classRepository = $classRepository;
    }

    public function isSetupComplete(School $school)
    {
        $this->setGlobalContext($school);

        return $this->isAcademicConfigurationComplete() &&
               $this->isSessionAndTermConfigurationComplete() &&
               $this->isClassConfigurationComplete();
    }

    private function isAcademicConfigurationComplete()
    {
        return  $this->gradeAssessmentSystemsRepository->isGradeAssessmentSystemConfigured() &&
                $this->gradingSystemsRepository->isGradingSystemConfigured();
    }

    private function isSessionAndTermConfigurationComplete(){
        return $this->scopedSessionRepository->isCurrentSessionConfigured();
    }

    private function isClassConfigurationComplete(){
        return $this->classRepository->isSchoolClassConfigured();
    }
}