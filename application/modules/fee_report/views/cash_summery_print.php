<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style type="text/css">
  @media print {
    * {
        -webkit-print-color-adjust: exact;
    }
  }
  table,th,td {
    border: 2px solid black;
    text-align: center;
  }
  .img-opacity {
    background-position: center;
    background-image: url("<?=STATIC_ADMIN_IMAGE.'logo.png'?>?>") !important;
    background-repeat: no-repeat;
  }
  div.transbox {
    margin: 30px;
    background-color: #ffffff;
    opacity: 0.9;
  }
  .border_top {
    border-top: 2px solid black;
  }
  .l-span{
    border-bottom: 1px solid black;
    width: 800px;
    display: inline-block;
    text-align: center;
  }
  .m-span{
    border-bottom: 1px solid black;
    width: 240px;
    display: inline-block;
    text-align: center;
  }
  .s-span  {
    border-bottom: 1px solid black;
    width: 120px;
    display: inline-block;
    text-align: center;
  }
</style>
<?php $i = 0;
$credit = 0;
$debit = 0;?>
<div class="container mt-2 img-opacity">
  <div class="transbox">
  <div class="row">
    <div class="col-md-2">
      <img src="<?php echo STATIC_ADMIN_IMAGE.'logo.png'?>" height="120px;">
    </div>
    <div class="col-md-8 ">
      <h1 style="text-align: center;">
      <?php echo $org[0]['org_name']; ?>
      </h1>
      <h5 class="display-5 text-break" style="text-align: center;">
        <?php echo $org[0]['org_address']; ?><br>
        Ph: <?php echo $org[0]['org_phone']; ?>
      </h5>
    </div>
  </div>
  <div class="col-md-12" style="text-align: center;"><h1>Cash Summery</h1></div>
  <table width="100%" class="mt-5">
    <thead>
      <th style="padding: 12px;">Sr.No</th>
      <th>Account Head</th>
      <th>Account Type</th>
      <th>Credit</th>
      <th>Debit</th>
    </thead>
    <tbody>
      <?php foreach ($account as $key => $value) { $i++;
        ?>
      <tr>
        <?php if($value['type'] == 'Cash-in-hand' || $value['type'] == 'Bank') {
          $debit = $debit + $value['opening_balance'];
          ?>
        <td style="padding: 12px;"><?=$i?></td>
        <td><?=$value['name']?></td>
        <td><?=$value['type']?></td>
        <td>0</td>
        <td><?=$value['opening_balance']?> PKR</td>
      
      <?php } elseif($value['type'] == 'Employee'){ ?>

      <?php } else {
      $credit = $credit + $value['opening_balance']; 
        ?>
        <td style="padding: 12px;"><?=$i?></td>
        <td><?=$value['name']?></td>
        <td><?=$value['type']?></td>
        <td><?=$value['opening_balance']?> PKR</td>
        <td>0</td>
      <?php } ?>
      </tr>
      <?php } ?>
      <!-- <?php foreach ($admin as $key => $value) { $i++;
        $credit = $credit + $value['opening_balance'];
        ?>
      <tr>
        <td style="padding: 12px;"><?=$i?></td>
        <td>Salaries</td>
        <td>Admin</td>
        <td><?=$value['opening_balance']?> PKR</td>
        <td>0</td>
      </tr>
      <?php } ?> -->
      <?php foreach ($teacher as $key => $value) { $i++;
        $credit = $credit + $value['amount'];
        ?>
      <tr>
        <td style="padding: 12px;"><?=$i?></td>
        <td>Salaries</td>
        <td>Faculty</td>
        <td><?=$value['amount']?> PKR</td>
        <td>0</td>
      </tr>
      <?php } ?>
      <tr>
        <td colspan="3" style="padding: 12px;"><b>Total</b></td>
        <td><b><?=$credit?> PKR</b></td>
        <td><b><?=$debit?> PKR</b></td>
      </tr>
      <tr>
        <td colspan="3" style="padding: 12px;"><b>Difference</b></td>
        <td colspan="2"><b><?=$debit-$credit?> PKR</b></td>
      </tr>
    </tbody>
  </table>

  <div class="row mt-5 pt-5" >
    <div class="col-md-4" style="text-align: center;">
      <h5 class="border_top">Incharge's Signature</h5>
    </div>
  </div>
  </div>
</div>
<p style="bottom: 0px;position: fixed"> Powered by XpertSpot </p>

<script type="text/javascript">

window.print();

</script>