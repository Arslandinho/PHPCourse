<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 18.05.2018
 * Time: 22:31
 */

use PHPUnit\Framework\TestCase;

require_once '../src/ComplexNumber.php';

class ComplexNumberTest extends TestCase
{
    /**
     * @var ComplexNumber
     *
     */
    private $complexNumber;

    public function setUp()
    {
        $this->complexNumber = new ComplexNumber(5, 4);
    }

    /**
     * @dataProvider providerAdd
     * @param float $a
     * @param float $b
     * @param float $expectedA
     * @param float $expectedB
     */
    public function testAddMethod(float $a, float $b, float $expectedA, float $expectedB) : void
    {
        $cn = new ComplexNumber($a, $b);
        $this->complexNumber->add($cn);
		$this->assertEquals(new ComplexNumber($expectedA, $expectedB), $this->complexNumber);
    }

	public function providerAdd()
	{
		return [
			[3, 3, 8, 7],
			[-1, 9, 4, 13],
			[2.2, 11, 7.2, 15],
			[2.1, -11.1, 7.1, -7.1],
            ['1', '9', '6', '13']
		];
	}

    /**
     * @dataProvider providerSub
     * @param float $a
     * @param float $b
     * @param float $expectedA
     * @param float $expectedB
     */
	public function testSubMethod(float $a, float $b, float $expectedA, float $expectedB) : void
    {
        $cn = new ComplexNumber($a, $b);
        $this->complexNumber->sub($cn);
        $this->assertEquals(new ComplexNumber($expectedA, $expectedB), $this->complexNumber);
    }

    public function providerSub()
    {
        return [
            [3, 3, 2, 1],
            [-1, 9, 6, -5],
            [2.2, 11, 2.8, -7],
            [2.1, -11.1, 2.9, 15.1],
            ['1', '9', '4', '-5']
        ];
    }

    /**
     * @dataProvider providerMult
     * @param float $a
     * @param float $b
     * @param float $expectedA
     * @param float $expectedB
     */
    public function testMultMethod(float $a, float $b, float $expectedA, float $expectedB) : void
    {
        $cn = new ComplexNumber($a, $b);
        $this->complexNumber->mult($cn);
        $this->assertEquals(new ComplexNumber($expectedA, $expectedB), $this->complexNumber);
    }

    public function providerMult()
    {
        return [
            [3, 3, 30, 0],
            [-1, 9, 40, -40],
            [2.2, 11, 66, -35.2],
            [2.1, -11.1, -45, 52.8],
            ['1', '9', '50', -32]
        ];
    }

    /**
     * @dataProvider providerDiv
     * @param float $a
     * @param float $b
     * @param float $expectedA
     * @param float $expectedB
     */
    public function testDivMethod(float $a, float $b, float $expectedA, float $expectedB) : void
    {
        $cn = new ComplexNumber($a, $b);
        $this->complexNumber->div($cn);
        $this->assertEquals(new ComplexNumber($expectedA, $expectedB), $this->complexNumber);
    }

    public function providerDiv()
    {
        return [
            [3, 3, 1.5, -0.16666666666667],
            [-1, 9, 0.3780487804878, -0.59756097560976],
            [2.2, 11, 0.43706293706294, -0.36713286713287],
            [2.1, -11.1, -0.26563234602727, 0.50070521861777],
            ['1', '9', 0.5, '-0.5']
        ];
    }

    /**
     * @dataProvider providerAbs
     * @param float $a
     * @param float $b
     * @param float $expected
     */
    public function testAbsMethod(float $a, float $b, float $expected) {
        $cn = new ComplexNumber($a, $b);
        $abs = $cn->abs();
        $this->assertEquals($expected, $abs);
    }

    public function providerAbs() {
        return [
            [3, 3, 4.2426406871193],
            [-1, 9, 9.0553851381374],
            [2.2, 11, 11.217842929904],
            [2.1, -11.1, 11.296902230258],
            ['1', '9', 9.0553851381374]
        ];
    }
}