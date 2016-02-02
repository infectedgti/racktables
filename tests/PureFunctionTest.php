<?php

/*
A pure function is a function where the return value is only determined by its
input values, without observable side effects. An unary function is a function
that takes one argument. Binary and ternary functions take two and three
arguments respectively.

For every given combination of pure function name, argument(s) and expected
return value test that the actual return value is equal (assertEqual) or
identical (assertSame) to the expected return value.
*/

class PureFunctionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider providerUnaryEquals
	 */
/*
	public function testUnaryEquals ($func, $input1, $output)
	{
		$this->assertEquals ($output, $func ($input1));
	}
*/

	/**
	 * @dataProvider providerUnarySame
	 */
	public function testUnarySame ($func, $input1, $output)
	{
		$this->assertSame ($output, $func ($input1));
	}

	/**
	 * @dataProvider providerBinaryEquals
	 */
	public function testBinaryEquals ($func, $input1, $input2, $output)
	{
		$this->assertEquals ($output, $func ($input1, $input2));
	}

	/**
	 * @dataProvider providerBinarySame
	 */
/*
	public function testBinarySame ($func, $input1, $input2, $output)
	{
		$this->assertSame ($output, $func ($input1, $input2));
	}
*/

	/**
	 * @dataProvider providerTernaryEquals
	 */
/*
	public function testTernaryEquals ($func, $input1, $input2, $input3, $output)
	{
		$this->assertEquals ($output, $func ($input1, $input2, $input3));
	}
*/

	/**
	 * @dataProvider providerTernarySame
	 */
/*
	public function testTernarySame ($func, $input1, $input2, $input3, $output)
	{
		$this->assertSame ($output, $func ($input1, $input2, $input3));
	}
*/

	public function providerUnaryEquals ()
	{
		return array
		(
		);
	}

	public function providerUnarySame ()
	{
		return array
		(
			// coalescing functions
			array ('nullIfEmptyStr', 'abc', 'abc'),
			array ('nullIfEmptyStr', '', NULL), // intended use case: '' == ''
			array ('nullIfEmptyStr', '0', '0'),
			array ('nullIfEmptyStr', 0, NULL), // type conversion: 0 == ''
			array ('nullIfEmptyStr', NULL, NULL), // type conversion: NULL == ''
			array ('nullIfEmptyStr', FALSE, NULL), // type conversion: FALSE == ''

			array ('nullIfFalse', '', ''),
			array ('nullIfFalse', '0', '0'),
			array ('nullIfFalse', 0, 0),
			array ('nullIfFalse', FALSE, NULL), // intended use case: FALSE === FALSE
			array ('nullIfFalse', NULL, NULL),

			array ('nullIfZero', 'abc', NULL), // type conversion: 'abc' == 0
			array ('nullIfZero', '', NULL), // type conversion: '' == 0
			array ('nullIfZero', '0', NULL), // type conversion: '0' == 0
			array ('nullIfZero', '1', '1'),
			array ('nullIfZero', 0, NULL), // intended use case: 0 == 0
			array ('nullIfZero', 1, 1),
			array ('nullIfZero', NULL, NULL), // type conversion: NULL == 0
			array ('nullIfZero', FALSE, NULL), // type conversion: FALSE == 0
		);
	}

	public function providerBinaryEquals ()
	{
		return array
		(
			array
			(
				'getSelectOptions',
				array
				(
					1 => 'one',
					2 => 'two',
					3 => 'three',
				),
				NULL,
				'<option value=\'1\'>one</option>' .
				'<option value=\'2\'>two</option>' .
				'<option value=\'3\'>three</option>'
			),
			array
			(
				'getSelectOptions',
				array
				(
					1 => 'one',
					2 => 'two',
					3 => 'three',
				),
				2,
				'<option value=\'1\'>one</option>' .
				'<option value=\'2\' selected>two</option>' .
				'<option value=\'3\'>three</option>'
			),
			array
			(
				'getSelectOptions',
				array
				(
					1 => 'one',
					2 => 'two',
					3 => 'three',
				),
				array(),
				'<option value=\'1\'>one</option>' .
				'<option value=\'2\'>two</option>' .
				'<option value=\'3\'>three</option>'
			),
			array
			(
				'getSelectOptions',
				array
				(
					1 => 'one',
					2 => 'two',
					3 => 'three',
				),
				array (2, 3),
				'<option value=\'1\'>one</option>' .
				'<option value=\'2\' selected>two</option>' .
				'<option value=\'3\' selected>three</option>'
			),
			array
			(
				'getSelectOptions',
				array
				(
					1 => '<one>',
					2 => '&two;',
					3 => '\'"three"\'',
					4 => '    ',
				),
				NULL,
				'<option value=\'1\'>&lt;one&gt;</option>' .
				'<option value=\'2\'>&amp;two;</option>' .
				'<option value=\'3\'>&#039;&quot;three&quot;&#039;</option>' .
				'<option value=\'4\'>    </option>'
			),
		);
	}

	public function providerBinarySame ()
	{
		return array
		(
		);
	}

	public function providerTernaryEquals ()
	{
		return array
		(
		);
	}

	public function providerTernarySame ()
	{
		return array
		(
		);
	}
}
?>