using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

/*
You are playing poker with your friends and need to evaluate your hand. 
A hand consists of five cards and is ranked, from lowest to highest, in the following way:


Task:
Output the rank of the give poker hand. 

Input Format: 
A string, representing five cards, each indicating the value and suite of the card, separated by spaces. 
Possible card values are: 2 3 4 5 6 7 8 9 10 J Q K A
Suites:  H (Hearts), D (Diamonds), C (Clubs), S (Spades)
For example, JD indicates Jack of Diamonds. 

Output Format:
A string, indicating the rank of the hand (in the format of the description above Rank class). 

Sample Input:
JS 2H JC AC 2D

Sample Output: 
Two Pairs
*/

namespace Sololearn
{
    class Program
    {
        static void Main(string[] args)
        {
            string inputHand = "7S 7S 4S 3S 7S";
            //string inputHand = Console.ReadLine();
            Hand hand = new Hand(inputHand);
            Console.WriteLine(Rank.Evaluate(hand));
            
        }
    }
    
    class Rank {
        public static string Evaluate(Hand hand)
        {
            bool scored = false;
            int checkIndex = 0;
            string[] checks = {
                "Royal Flush",
                "Straight Flush",
                "Four of a Kind",
                "Full House",
                "Flush",
                "Straight",
                "Three of a Kind",
                "Two Pairs",
                "One Pair",
                "High Card"
            };

            do 
            {
                scored = Rank.evaluate(checks[checkIndex], hand);
                if(scored) return checks[checkIndex];
                else checkIndex++;
            }
            while(!scored);
            return "No valid hand detected";      
        }

            /*
                High Card: Highest value card (from 2 to Ace).
                One Pair: Two cards of the same value.
                Two Pairs: Two different pairs.
                Three of a Kind: Three cards of the same value.
                Straight: All cards are consecutive values.
                Flush: All cards of the same suit.
                Full House: Three of a kind and a pair.
                Four of a Kind: Four cards of the same value.
                Straight Flush: All cards are consecutive values of same suit.
                Royal Flush: 10, Jack, Queen, King, Ace, in same suit. 
            */
        
        public static bool evaluate(string check, Hand hand)
        {
            switch(check) {
                case "Royal Flush":
                    return IsRoyalFlush(hand);                    
                case "Straight Flush":
                    return IsStraightFlush(hand);
                case "Four of a Kind":
                    return IsFourofaKind(hand);
                case "Full House":
                    return IsFullHouse(hand);
                case "Flush":
                    return IsFlush(hand);
                case "Straight":
                    return IsStraight(hand);
                case "Three of a Kind":
                    return IsThreeofaKind(hand);
                case "Two Pairs":
                    return IsTwoPairs(hand);
                case "One Pair":
                    return IsOnePair(hand);
                case "High Card":
                    return IsHighCard(hand);
                default:
                    Console.WriteLine("Error: No valid condition met! {0} passed", check);
                    return false;
            }
        }

        public static bool IsRoyalFlush(Hand hand)
        {
           bool isSameSuit = IsFlush(hand);
           bool isRoyalFlushValue = (hand.Values.AsQueryable().Sum() == 60);
           
           if (isSameSuit && isRoyalFlushValue) return true;
           else return false;
        }

        public static bool IsStraightFlush(Hand hand)
        {
            return (IsFlush(hand) && IsStraight(hand));
        }

        public static bool IsFourofaKind(Hand hand)
        {
            var groupedValues = hand.Values.GroupBy(i => i);
            foreach (var grp in groupedValues)
            {
                if(grp.Count() == 4)
                {
                    return true;
                }
            }
            return false;
        }

        public static bool IsFullHouse(Hand hand)
        {
            return (IsThreeofaKind(hand) && IsOnePair(hand));
        }

        public static bool IsFlush(Hand hand)
        {
            string refSuit = hand.Suits[0];
            return hand.Suits.TrueForAll(x => (x == refSuit));
        }
        
        public static bool IsStraight(Hand hand)
        {
            int j=1;
            for(int i=0;i < hand.Values.Count-1; i++)
            {
                 if (hand.Values[i]+1 == hand.Values[j])
                 {
                      j++;
                      continue;
                 }
        
                 else 
                 { 
                      return false;
                 }                
            }
            return true;
        }

        public static bool IsThreeofaKind(Hand hand)
        {
            var groupedValues = hand.Values.GroupBy(i => i);
            foreach (var grp in groupedValues)
            {
                if(grp.Count() == 3)
                {
                    return true;
                }
            }
            return false;
        }

        public static bool IsTwoPairs(Hand hand)
        {
            var groupedValues = hand.Values.GroupBy(i => i);
            int paircount = 0;
            foreach (var grp in groupedValues)
            {
                if(grp.Count() == 2)
                {
                    paircount++;
                }
                else continue;
            }
            if (paircount == 2) return true;
            else return false;
        }

        public static bool IsOnePair(Hand hand)
        {
            var groupedValues = hand.Values.GroupBy(i => i);
            foreach (var grp in groupedValues)
            {
                if(grp.Count() == 2)
                {
                    return true;
                }
            }
            return false;
        }

        public static bool IsHighCard(Hand hand)
        {
            // This is the rank if nothing else found, so just return true
            return true;
        }
    }

    class Hand
    {
        public Hand(string input)
        {
            this.Cards = ParseHand(input);
            this.Values = GetValues();
            this.Suits = GetSuits();
        }

        public Card this[int index] {
            get {
                return Cards[index];
            }
            set {
                Cards[index] = value;
            }
        }
        

        private List<Card> ParseHand(string cards)
        {
            List<Card> hand = new List<Card>();
            string[] cardArr = cards.Split(" ");
            foreach(string card in cardArr)
            {
                hand.Add(new Card(card));
            }
            return hand;
            
        }
        
        private List<string> GetSuits() 
        {
            List<string> suits = new List<string>();
            foreach(Card card in Cards)
            {
                suits.Add(card.Suit);
            }
            return suits;
        }
        
        private List<int> GetValues()
        {
            List<int> values = new List<int>();
            foreach(Card card in Cards)
            {
                values.Add(card.Value);
            }
            values.Sort();
            return values;
        }
        
        public List<Card> Cards { get; set; }
        public List<int> Values { get; set; }
        public List<string> Suits { get; set; }
    }

    class Card 
    {
        public string Suit { get; set; }
        public int Value { get; set; }
        public static Dictionary<string,int> CardValues = new Dictionary<string, int>()
        {
            {"J", 11},
            {"Q", 12},
            {"K", 13},
            {"A", 14}            
        };
        
        public Card(string card)
        {
            Value = ParseValue(card.Substring(0,1));
            Suit = ParseSuit(card);
        }
        
        public int ParseValue(string cardval)
        {
            if(int.TryParse(cardval, out int val))
            {
                if (val == 1) return 10;
                else return val;
            }
            else {
                return CardValues[cardval];
            }
        }

        public string ParseSuit(string card)
        {
            if(card.Substring(1,1) == "0")
            {
                return card.Substring(2,1);
            }
            else return card.Substring(1,1);

        }
    }
}
