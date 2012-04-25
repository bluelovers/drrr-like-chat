<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

/**
 *
 * @example
 * $a = new Dura_Class_Array();

 * $a->a = 1;
 * $a['b'] = 2;

 * echo '<pre>';
 * var_dump($a);

 * var_dump(array(
 * $a['a'],
 * $a->b,
 * (ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS),
 * ));
 */
class Dura_Class_Array extends ArrayObject
{

	/**
	 * Dura_Class_Array::ARRAY_PROP_BOTH = (ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
	 */
	const ARRAY_PROP_BOTH = 3;

	protected $_data_default_ = array();

	function __construct($input = null)
	{
		if ($input === null) $input = $this->_data_default_;

		$this->setFlags(ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
		$this->exchangeArray($input);
	}

	function toArray()
	{
		return $this->getArrayCopy();
	}

}
