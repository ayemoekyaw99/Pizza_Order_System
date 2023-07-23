 $(document).ready(function() {

     $('.btn-plus').click(function() {
         // console.log($(this))
         $parentNode = $(this).parents('tr');

         // one way
         // $pizzaPrice=$parentNode.find('.pizzaPrice').val()
         // //console.log($pizzaPrice)
         // $quantity=$parentNode.find('.qty').val()
         // // console.log($quantity)
         // $total=$pizzaPrice*$quantity
         // // console.log($total)
         // $parentNode.find('.total').html($total + "kyats")

         //second way
         // $pizzaPrice=($parentNode.find('#pizzaPrice').text().replace('kyats','')*1);or
         $pizzaPrice = parseInt($parentNode.find('#pizzaPrice').text().replace('kyats', ''));
         $quantity = $parentNode.find('.qty').val();
         $total = $pizzaPrice * $quantity;
         // $parentNode.find('.total').text($total + ' kyats'); or
         $parentNode.find('.total').html(`${$total} kyats`);

         summaryCalculation();
     })


     $('.btn-minus').click(function() {
         $parentNode = $(this).parents('tr');
         //second way
         // $pizzaPrice=($parentNode.find('#pizzaPrice').text().replace('kyats','')*1);or
         $pizzaPrice = parseInt($parentNode.find('#pizzaPrice').text().replace('kyats', ''));
         $quantity = $parentNode.find('.qty').val();
         $total = $pizzaPrice * $quantity;
         // $parentNode.find('.total').text($total + ' kyats'); or
         $parentNode.find('.total').html(`${$total} kyats`);

         summaryCalculation();
     })

     //calculate final price
     function summaryCalculation() {
         $totalPrice = 0;
         $('.tableData tbody tr').each(function(index, row) {
             //console.log(index + '///'+row)
             $totalPrice += parseInt($(row).find('.total').text().replace('kyats', ''));
         });
         $('.subTotal').text(`${$totalPrice}`);
         $('.totalPrice').text(`${$totalPrice+3000} kyats`);
     }
 })