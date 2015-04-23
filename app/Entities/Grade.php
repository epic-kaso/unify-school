<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/30/2015
 * Time: 1:05 PM
 */

namespace UnifySchool\Entities;


class Grade
{

    public $symbol;
    public $lowerRange;
    public $upperRange;
    public $remark;

    /**
     * @return mixed
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param mixed $symbol
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }

    /**
     * @return mixed
     */
    public function getLowerRange()
    {
        return $this->lowerRange;
    }

    /**
     * @param mixed $lowerRange
     */
    public function setLowerRange($lowerRange)
    {
        $this->lowerRange = $lowerRange;
    }

    /**
     * @return mixed
     */
    public function getUpperRange()
    {
        return $this->upperRange;
    }

    /**
     * @param mixed $upperRange
     */
    public function setUpperRange($upperRange)
    {
        $this->upperRange = $upperRange;
    }

    /**
     * @return mixed
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * @param mixed $remark
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
    }

}