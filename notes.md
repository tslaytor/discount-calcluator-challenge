Provider	Package Size	Price
   LP	          S 	    1.50 €
   LP	          M 	    4.90 €
   LP	          L 	    6.90 €
   MR	          S 	    2 €
   MR	          M 	    3 €
   MR	          L 	    4 €


1. All S shipments should always match the lowest S package price among the providers.
2. The third L shipment via LP should be free, but only once a calendar month.
3. Accumulated discounts cannot exceed 10 € in a calendar month. If there are not enough funds to fully cover a discount this calendar month, it should be covered partially.


2015-02-01 S MR
2015-02-02 S MR
2015-02-03 L LP
2015-02-05 S LP
2015-02-06 S MR
2015-02-06 L LP
2015-02-07 L MR
2015-02-08 M MR
2015-02-09 L LP
2015-02-10 L LP
2015-02-10 S MR
2015-02-10 S MR
2015-02-11 L LP
2015-02-12 M MR
2015-02-13 M LP
2015-02-15 S MR
2015-02-17 L LP
2015-02-17 S MR
2015-02-24 L LP
2015-02-29 CUSPS
2015-03-01 S MR

idea
make a class per rule and __invoke it

rules 1 and 3, which takes precedence? - 3 I guess

SmallMatchesLowestPrice - always returns the lowest price (1.50) unless rule 3
ThirdLargeFromLpFreeOncePerMonth - makes 3rd large from LP free, if not done already this month
AccumulatedDiscountLimitToTenEuro - limits the total discount to 10 euros, if there is credit left but the discount would go beyond the credit limit, discount only to the credit limit