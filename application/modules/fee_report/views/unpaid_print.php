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
$month1 = date("F", strtotime($report[0]['due_date']));
$total = 0;
$paid = 0;
$remaining = 0;?>
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
  <div class="col-md-12" style="text-align: center;"><h1>Unpaid Fee Report</h1></div>
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
      <th>Month</th>
      <th>Student Name - Roll No</th>
      <th>Parent Name</th>
      <th>Class - Section</th>
      <th>Total</th>
      <th>Paid</th>
      <th>Balance</th>
    </thead>
    <tbody>
      <?php foreach ($report as $key => $value) { $i++;
        $total = $total + $value['total'];
        $paid = $paid + $value['paid'];
        $remaining = $remaining + $value['remaining'];
        if ($month1!=date("F", strtotime($value['due_date']))) { 
        $month1 = date("F", strtotime($value['due_date']));?>
      <tr >
        <td colspan="100%" style="padding: 15px; background-color: grey"><b><?=$month1?></b></td>
      </tr>
      <?php } ?>
      <tr>
        <td style="padding: 12px;"><?=$i?></td>
        <td><?php echo date("F-Y", strtotime($value['due_date']))?></td>
        <td><?php echo $value['std_name'].' - '.$value['std_roll_no']?></td>
        <td><?php echo $value['parent_name']?></td>
        <td><?php echo $value['class_name'].' - '.$value['section_name']?></td>
        <td><?=$value['total']?></td>
        <td><?=$value['paid']?></td>
        <td><?=$value['remaining']?></td>
      </tr>
      <?php } ?>
      <tr>
        <td colspan="5" style="padding: 12px;"><b>Total</b></td>
        <td><b><?=$total?></b></td>
        <td><b><?=$paid?></b></td>
        <td><b><?=$remaining?></b></td>
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