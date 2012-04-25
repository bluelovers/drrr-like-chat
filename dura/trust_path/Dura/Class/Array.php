<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

class Dura_Class_Array implements Iterator, Countable, ArrayAccess
{
	protected $_data_key_ = '_data_array_';

	protected $_data_array_ = array();

	protected function &__get_array__()
	{
		return $this->{$_data_key_};
	}

	/**
	 * http://php.net/manual/en/class.countable.php
	 */
	function count()
	{
		return count($this->__get_array__());
	}

	/**
	 * http://php.net/manual/en/class.arrayaccess.php
	 */
	public function offsetSet($offset, $value)
	{
		if (is_null($offset))
		{
			$this->{$_data_key_}[] = $value;
		}
		else
		{
			$this->{$_data_key_}[$offset] = $value;
		}
	}

	public function offsetExists($offset)
	{
		return isset($this->{$_data_key_}[$offset]);
	}

	public function offsetUnset($offset)
	{
		unset($this->{$_data_key_}[$offset]);
	}

	public function offsetGet($offset)
	{
		return isset($this->{$_data_key_}[$offset]) ? $this->{$_data_key_}[$offset] : null;
	}

	/**
	 * http://www.php.net/manual/en/class.iterator.php
	 */
	function rewind()
	{
		return reset($this->{$_data_key_});
	}

	function current()
	{
		return current($this->{$_data_key_});
	}

	function key()
	{
		return key($this->{$_data_key_});
	}

	function next()
	{
		return next($this->{$_data_key_});
	}

	function prev()
	{
		return prev($this->{$_data_key_});
	}

	function valid()
	{
		return $this->offsetExists($this->key());
	}
}
