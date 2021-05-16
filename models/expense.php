<?php

class Expense
{
    private $category;
    private $expenses;

   

    public function __construct($category,$expenses)
    {
        
            $this->category = $category;
            $this->expenses = $expenses;
               
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($c)
    {
        $this->category = $c;
    }

    /**
     * @return mixed
     */
    public function getExpense()
    {
        return $this->expenses;
    }

    /**
     * @param mixed $price
     */
    public function setExpense($e)
    {
        $this->expenses = $expenses;
    }

   
 

    public function toArray () {
        return [
            "Category" => $this->getCategory(),
            "Expenses" => $this->getExpense(),
            
        ];
    }
}