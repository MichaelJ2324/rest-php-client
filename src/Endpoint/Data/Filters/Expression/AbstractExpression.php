<?php
/**
 * ©[2016] SugarCRM Inc.  Licensed by SugarCRM under the Apache 2.0 license.
 */

namespace Sugarcrm\REST\Endpoint\Data\Filters\Expression;

use Sugarcrm\REST\Endpoint\Data\Filters\FilterInterface;
use Sugarcrm\REST\Exception\Filter\UnknownFilterOperator;

/**
 * Class AbstractExpression
 * @package Sugarcrm\REST\Endpoint\Data\Filters\Expression
 * @method AndExpression            and()
 * @method OrExpression             or()
 * @method AbstractExpression       equals($field,$value)
 * @method AbstractExpression       not_equals($field,$value)
 * @method AbstractExpression       starts($field,$value)
 * @method AbstractExpression       ends($field,$value)
 * @method AbstractExpression       contains($field,$value)
 * @method AbstractExpression       in($field,array $value)
 * @method AbstractExpression       notIn($field,array $value)
 * @method AbstractExpression       isNull($field)
 * @method AbstractExpression       notNull($field)
 * @method AbstractExpression       lt($field,$value)
 * @method AbstractExpression       lessThan($field,$value)
 * @method AbstractExpression       lte($field,$value)
 * @method AbstractExpression       lessThanOrEqualTo($field,$value)
 * @method AbstractExpression       lessThanOrEquals($field,$value)
 * @method AbstractExpression       greaterThan($field,$value)
 * @method AbstractExpression       gte($field,$value)
 * @method AbstractExpression       greaterThanOrEqualTo($field,$value)
 * @method AbstractExpression       greaterThanOrEquals($field,$value)
 */
abstract class AbstractExpression implements FilterInterface, ExpressionInterface
{
    /**
     * @var array
     */
    private $filters = array();

    /**
     * @var AbstractExpression
     */
    private $parentExpression;

    /**
     * @var array
     */
    protected $operators = array(
        'equals' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\Equals',
        'not_equals' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\NotEquals',
        'starts' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\Starts',
        'ends' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\Ends',
        'contains' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\Contains',
        'in' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\In',
        'notIn' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\NotIn',
        'isNull' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\IsNull',
        'notNull' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\NotNull',
        'lt' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\LessThan',
        'lessThan' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\LessThan',
        'lte' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\LessThanOrEqual',
        'lessThanOrEqualTo' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\LessThanOrEqual',
        'lessThanOrEquals' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\LessThanOrEqual',
        'gt' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\GreaterThan',
        'greaterThan' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\GreaterThan',
        'gte' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\GreaterThanOrEqual',
        'greaterThanOrEqualTo' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\GreaterThanOrEqual',
        'greaterThanOrEquals' => 'Sugarcrm\REST\Endpoint\Data\Filters\Operator\GreaterThanOrEqual',
    );

    /**
     * @var array
     */
    protected $expressions = array(
        'and' => 'Sugarcrm\REST\Endpoint\Data\Filters\Expression\AndExpression',
        'or' => 'Sugarcrm\REST\Endpoint\Data\Filters\Expression\OrExpression',
    );

    /**
     * @param $name
     * @param $arguments
     * @return AbstractExpression
     * @throws UnknownFilterOperator
     */
    public function __call($name, $arguments)
    {
        if (array_key_exists($name,$this->operators)){
            $Operator = $this->operators[$name];
            $Op = new $Operator($arguments);
            $this->filters[] = $Op;
            return $this;
        }
        if (array_key_exists($name,$this->expressions)){
            $Expression =  $this->expressions[$name];
            $Exp = new $Expression();
            $Exp->setParentExpression($this);
            $this->filters[] = $Exp;
            return $Exp;
        }
        throw new UnknownFilterOperator(array($name));
    }

    /**
     * Sets Parent Expression to allow for nested tree structure
     * @param AbstractExpression $Expression
     * @return $this
     */
    public function setParentExpression(AbstractExpression $Expression){
        $this->parentExpression = $Expression;
        return $this;
    }

    /**
     * Gets the Parent Expression of current Expression
     * @return AbstractExpression
     */
    public function getParentExpression(){
        return $this->parentExpression;
    }

    /**
     * Compiles the Expression based on the stored Filters array
     * @return array
     */
    public function compile()
    {
        $data = array();
        foreach($this->filters as $filter){
            $data[] = $filter->compile();
        }
        return $data;
    }

    public function clear()
    {
        $this->filters = array();
        return $this;
    }

}