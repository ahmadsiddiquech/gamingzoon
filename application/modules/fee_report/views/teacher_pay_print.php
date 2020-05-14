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
$month1 = date("F", strtotime($report[0]['fee_month']));
$received = 0;
$receivable = 0;
$balance = 0;?>
<div class="container mt-2 img-opacity">
  <div class="transbox">
  <div class="row">
    <div class="col-md-2">
      <img src="<?php echo STATIC_ADMIN_IMAGE.'logo.png'?>" height="120px;">
    </div>
    <div class="col-md-8 ">
      <h1 style="text-align: center;">
      <?php echo $report[0]['org_name']; ?>
      </h1>
      <h5 class="display-5 text-break" style="text-align: center;">
        <?php echo $report[0]['org_address']; ?><br>
        Ph: <?php echo $report[0]['org_phone']; ?>
      </h5>
    </div>
  </div>
  <div class="col-md-12" style="text-align: center;"><h1>Teacher Pay Report</h1></div>
  <div class="row mt-5">
    <div class="col-md-4">
      <h5>Teacher Name: <span class="s-span"> <?=$report[0]['teacher_name']; ?></span></h5>
    </div>
    <div class="col-md-4" style="text-align: right">
      <h5>Phone: <span class="s-span"> <?=$report[0]['phone']; ?></span></h5>
    </div>
  </div>
  <div class="row mt-2">
    <div class="col-md-6">
      <h5>From Date:<span class="m-span"> <?php echo date("d-F-Y", strtotime($from_date));?></span></h5>
    </div>
    <div class="col-md-6" style="text-align: right">
      <h5>To Date:<span class="m-span"> <?php echo date("d-F-Y", strtotime($to_date)); ?></span></h5>
    </div>
  </div>
  <table width="100%" class="mt-5">
    <thead>
      <th style="padding: 12px;">Sr.No</th>
      <th>Date</th>
      <th>Transaction Type</th>
      <th>Debit</th>
      <th>Credit</th>
      <th>Balance</th>
    </thead>
    <tbody>
      <?php foreach ($report as $key => $value) { $i++;
        if ($month1!=date("F", strtotime($value['fee_month']))) { 
        $month1 = date("F", strtotime($value['fee_month']));?>
      <tr>
        <td colspan="100%" style="padding: 15px; background-color: grey"><b><?=$month1?></b></td>
      </tr>
      <?php } ?>
      <tr>
        <?php if (isset($value['teacher_share']) && !empty($value['teacher_share'])) { 
          $receivable = $receivable + $value['teacher_share'];
          $balance = $balance + $value['teacher_share'];
          ?>
          <td style="padding: 12px;"><?=$i?></td>
          <td><?php echo date("d-F-Y", strtotime($value['fee_month']));?></td>
          <td><?=$value['std_name'].' - '.$value['subject_name']?></td>
          <td><?=$value['teacher_share']?> PKR</td>
          <td>0 PKR</td>
          <td><?=$balance?> PKR</td>
        <?php }  elseif (isset($value['account_from_name']) && !empty($value['account_from_name'])) { 
          $received = $received + $value['amount'];
          $balance = $balance - $value['amount'];
          ?>
          <td style="padding: 12px;"><?=$i?></td>
          <td><?php echo date("d-F-Y", strtotime($value['fee_month']));?></td>
          <td><?=$value['account_from_name'].' - '.$value['transaction_type']?></td>
          <td>0 PKR</td>
          <td><?=$value['amount']?> PKR</td>
          <td><?=$balance?> PKR</td>
        <?php } ?>
      </tr>
      <?php } ?>
      <tr>
        <td colspan="3" style="padding: 12px;"><b>Total</b></td>
        <td><b><?=$receivable?> PKR</b></td>
        <td><b><?=$received?> PKR</b></td>
        <td><b><?=$balance?> PKR</b></td>
      </tr>
      <tr>
        <td colspan="3" style="background-color: lightgrey;font-size: 30px"><b>Account Balance</b></td>
        <td colspan="3" style="padding: 20px;background-color: lightgrey;font-size: 30px"><b><?=$balance?> PKR</b></td>
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