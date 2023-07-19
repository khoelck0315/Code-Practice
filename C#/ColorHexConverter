using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

/*
You are starting a new company and unfortunately that means you can no longer rely on the free hex-color code software you used to rely on. It’s time to put your skills to the test and create one from the ground up!

Task: 
Create a function that accepts three integers that represent the RGB (red, green, blue) values and outputs the hex-code representation.

Input Format: 
Three integers that represent RGB values.

Output Format: 
The hexadecimal color code string that corresponds with the entered RGB values.

Sample Input: 
100 
200 
233

Sample Output: 
#64c8e9
*/

namespace Sololearn
{
    class Program
    {
        public static void Main(string[] args)
        {
            try
            {
                int r = GetInput();
                int g = GetInput();
                int b = GetInput();
                Color color = new Color(r,g,b);               Console.WriteLine(color.GetHexCode());
                Console.WriteLine(color.GetRgbCode());
            }
            catch(Exception e)
            {
                Console.WriteLine(e.Message);
            }
        }
        
        public static int GetInput()
        {
            string input = Console.ReadLine();
            try
            {
                int ret = Convert.ToInt32(input);
                if (ret > 255 || ret < 0)
                {
                    throw new Exception();
                }
                return ret;
            }  
            catch(Exception e)
            {
                Console.WriteLine(e.Message);
                return -1;
            }
        }
    }
    
    class Color
    {
        public Color(int red, int green, int blue)
        {
            this.Red = red;
            this.Green = green;
            this.Blue = blue;
        }
        
        public string GetHexCode()
        {
            string r = this.Red.ToString("X").ToLower();
            string g = this.Green.ToString("X").ToLower();
            string b = this.Blue.ToString("X").ToLower();
            return "#"+r+g+b;          
        }
        
        public string GetRgbCode()
        {
            return $"Rgb({this.Red.ToString()},{this.Green.ToString()},{this.Blue.ToString()})";
        }
        
        public int Red { get; set; }
        public int Green { get; set; }
        public int Blue { get; set; }
    }
}
