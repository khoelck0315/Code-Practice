using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;


namespace Sololearn
{
/*
You need to verify if the given credit card number is valid. For that you need to use the Luhn test.



Task: 
Given a credit card number, validate that it is valid using the Luhn test. Also, all valid cards must have exactly 16 digits.

Input Format:
A string containing the credit card number you need to verify.

Output Format:
A string: 'valid' in case the input is a valid credit card number (passes the Luhn test and is 16 digits long), or 'not valid', if it's not.

Sample Input:
4091131560563988
*/
    class Program
    {
        static void Main(string[] args)
        {
            string cardNumber = Console.ReadLine();
            CreditCard creditCard = new CreditCard(cardNumber); 
            if(!creditCard.PreValidate()) Console.WriteLine("not valid");
            else Console.WriteLine(creditCard.Validate());
        }
    
    }
    
    class CreditCard
    {
        public string CardNumber
        {
            get; set;      
        }

        private string _cardNumber;
        
        public CreditCard(string num)
        {
            this.CardNumber = num;
        }
        public bool PreValidate()
        {
            if(this.CardNumber.Length != 16) return false;
            else return true;
        }
        public string Validate()
        {
             /*
            Here is the Luhn formula:
            1. Reverse the number.
            2. Multiple every second digit by 2                                          
            3. Subtract 9 from all numbers higher than 9.
            4. Add all the digits together.
            5. Modulo 10 of that sum should be equal to 0. 
              */
            int[] workingNum = new int[16];                 
            Reverse(ref workingNum);
            // Debugging - check current state of array
            //Array.ForEach(workingNum, Console.WriteLine);
            Multiply(ref workingNum);
            Subtract(ref workingNum);
            int sum = Sum(workingNum);
            if(Modulo10(sum)) return "valid";
            else return "not valid";
        }
        
        private void Reverse(ref int[] workingNum) 
        {
            string num = this.CardNumber;
            int j=0;
            for(int i=(num.Length-1);i>=0;i--)
            {
                workingNum[j] = (int)Char.GetNumericValue(num[i]);
                j++;                
            }
        }
        
        private void Multiply(ref int[] num) 
        {
            for(int i=0;i<num.Length;i++)
            {
                if(i%2!=0)
                {
                   num[i] *= 2;
                }  
                
                else continue;
            }
        }
        
        private void Subtract(ref int[] num)
        {
            for(int i=0;i<num.Length;i++)
            {
                if(num[i] > 9)
                {
                    num[i] -= 9;
                }
                else continue;
            }
        }
        
        private int Sum(int[] num)
        {
            int sum = 0;
            for(int i=0;i<num.Length;i++)
            {
               sum += Convert.ToInt32(num[i]);
            }
            return sum;
        }
        
        private bool Modulo10(int sum)
        {
            if(sum%10 == 0) return true;
            else return false;
        }
    }
}
