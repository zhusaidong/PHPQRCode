<?php
/**
* 多项式
* @author Zsdroid [635925926@qq.com]
*/
namespace PHPQRCode;

class Polynomial
{
	private $polynomial = [];
	//表达式字幕
	private $value = 'x';
	/**
	* @var 简化模式
	* 	当 "系数=0/1,指数=0" 时,简化表达式
	*/
	private $simplyMode = FALSE;
	public function __construct()
	{
	}
	public function setValue($value)
	{
		$this->value = $value;
	}
	public function setSimplyMode($simplyMode)
	{
		$this->simplyMode = $simplyMode;
	}
	/**
	* 设置多项式
	* @param int $polynomial_exponent 多项式指数
	* @param double $polynomial_coefficient 多项式系数
	*/
	public function setPolynomial($polynomial_exponent,$polynomial_coefficient)
	{
		$this->polynomial[] = [
			'exponent' 		=>$polynomial_exponent,
			'coefficient' 	=>$polynomial_coefficient,
		];
		return $this;
	}
	/**
	* 获取多项式
	* 
	* @return array 多项式对象数组
	*/
	public function getPolynomial()
	{
		usort($this->polynomial,
			function($a,$b)
			{
				if($a['exponent'] >= $b['exponent'])
				{
					return -1;
				}
				return 1;
			});
		return $this->polynomial;
	}
	/**
	* __toString
	* 
	* @return string 多项式 toString
	*/
	public function __toString()
	{
		$polynomialExpression = [];
		foreach($this->getPolynomial() as $value)
		{
			$coefficient = $value['coefficient'];
			if($this->simplyMode and is_numeric($coefficient))
			{
				if($coefficient == 0)
				{
					continue;
				}
				if($coefficient == 1)
				{
					$coefficient = '';
				}
			}
			
			$exponent = $value['exponent'];
			if($this->simplyMode and $exponent == 0)
			{
				$exponent = '';
			}
			else
			{
				$exponent = $this->value.'<sup>'.$value['exponent'].'</sup>';
			}
			$polynomialExpression[] = $coefficient.$exponent;
		}
		return str_replace('+-','-',implode('+',$polynomialExpression));
	}
	/**
	* toArray
	* 
	* @return array 多项式数组
	*/
	public function toArray()
	{
		$array = [];
		foreach($this->getPolynomial() as $value)
		{
			$array[$value['exponent']] = $value['coefficient'];
		}
		return $array;
	}
	
	/**
	* 除法
	* @param Polynomial $polynomial 除数多项式
	*/
	public function division(Polynomial $polynomial)
	{
		$polynomialDividend = $this->toArray();//被除数
		$polynomialDivisor = $polynomial->toArray();//除数
		
		foreach($polynomialDivisor as $key => $value)
		{
			if(!isset($polynomialDividend[$key]))
			{
				$polynomialDividend[$key] = 0;
			}
		}
		
		foreach($polynomialDividend as $key => $value)
		{
			$polynomialDividend[$key] = $value ^ (isset($polynomialDivisor[$key])?$polynomialDivisor[$key]:0);
		}
		
		$this->polynomial = [];
		foreach($polynomialDividend as $key => $value)
		{
			if($value != 0)
			{
				$this->setPolynomial($key,$value);
			}
		}
		
		unset($polynomialDividend,$polynomialDivisor,$polynomial);
	}
	//单项式乘法(多项式乘法涉及卷积很复杂)
	public function multiplication(Polynomial $polynomial)
	{
		$polynomial1 = $this->toArray();
		$polynomial2 = $polynomial->getPolynomial();
		
		$polynomialArr = [];
		foreach($polynomial1 as $key => $value)
		{
			$polynomialArr[$key + $polynomial2[0]['exponent']] = $value * $polynomial2[0]['coefficient'];
		}
		
		$this->polynomial = [];
		foreach($polynomialArr as $key => $value)
		{
			if($value != 0)
			{
				$this->setPolynomial($key,$value);
			}
		}
		unset($polynomial1,$polynomial2,$polynomial,$polynomialArr);
	}
}
