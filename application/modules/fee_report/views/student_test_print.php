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
$obt = 0;
$total = 0;
$month1 = date("F", strtotime($report[0]['test_date']));?>
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
  <div class="col-md-12" style="text-align: center;"><h1>Student Test Report</h1></div>
  <div class="row mt-5">
    <div class="col-md-4">
      <h5>Student Name: <span class="s-span"> <?=$report[0]['std_name']; ?></span></h5>
    </div>
  </div>
  <div class="row mt-2">
    <div class="col-md-6">
      <h5>Class Name:<span class="m-span"> <?=$report[0]['class_name']; ?></span></h5>
    </div>
    <div class="col-md-6" style="text-align: right">
      <h5>Section Name:<span class="m-span"><?=$report[0]['section_name']; ?></span></h5>
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
      <th>Test Date</th>
      <th>Test Title</th>
      <th>Subject Name</th>
      <th>Class - Section</th>
      <th>Obtained/Total</th>
    </thead>
    <tbody>
      <?php foreach ($report as $key => $value) { $i++;
        $obt = $obt + $value['obtained_marks'];
        $total = $total + $value['total_marks'];

      if ($month1!=date("F", strtotime($value['test_date']))) { 
        $month1 = date("F", strtotime($value['test_date']));?>
      <tr >
        <td colspan="100%" style="padding: 15px; background-color: grey"><b><?=$month1?></b></td>
      </tr>
      <?php } ?>
      <tr>
        <td style="padding: 12px;"><?=$i?></td>
        <td><?=date("d-F-Y", strtotime($report[0]['test_date']));?></td>
        <td><?=$value['test_title'];?></td>
        <td><?=$value['subject_name']?></td>
        <td><?=$value['class_name'].' - '.$value['section_name']?></td>
        <td><?=$value['obtained_marks'].'/'.$value['total_marks']?></td>
      </tr>
      <?php } ?>
      <tr>
        <td colspan="5" style="padding: 12px;"><b>Percentage</b></td>
        <td><b><?php echo ($obt/$total)*100 ?> %</b></td>
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