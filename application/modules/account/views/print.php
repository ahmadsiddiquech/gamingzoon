<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<style type="text/css">
  @media print {
    html, body {
      width: 80mm;
      font-family: 'Roboto', sans-serif;
    }
  }
  @page { margin: 0; }
  body {
    font-family: 'Roboto', sans-serif;
  }
  .border_bottom {
    border-bottom: 2px solid black;
  }
  .border1 {
    border-left:1px solid black;
    border-top:1px solid black;
  }
</style>
<body>
<?php $x = 1; $y = 1; ?>
<table width="100%">
  <tr>
    <td>
      <table width="100%">
      <tbody>
        <tr>
          <td colspan="100%" align="center"><b style="font-size: 22px;"> <?php echo $invoice[0]['org_name']?></b><br><?php echo $invoice[0]['org_address']?><br>Tel: <?php echo $invoice[0]['org_phone'];?></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
          <th class="border_bottom" colspan="100%"></th>
        </tr>
        <tr>
          <td colspan="100%">Issue Date: <b><?php echo date("d-F-Y", strtotime($invoice[0]['fee_issue_date']))?></b></td>
        </tr>
        <tr>
          <td colspan="100%">Fee Month: <b><?php echo date("F-Y", strtotime($invoice[0]['fee_month']))?></b></td>
        </tr>
        <tr>
          <td colspan="100%">Invoice id: <b><?php echo $invoice[0]['c_r_id'];?></b></td>
        </tr>
        <tr><td colspan="100%">&nbsp;</td></tr>
        <tr><td colspan="100%"><hr></td></tr>
        <tr align="center">
          <th colspan="1" class="border1"><b>Student Details</th>
          <th colspan="1" class="border1"><b>Subject Details</th>
          <th colspan="1" class="border1"><b>Class Details</th>
          <th colspan="1" class="border1" style="border-right: 1px solid black"><b>Fee</th>
        </tr>
        <?php foreach ($invoice as $key => $value) { ?>
        <tr align="center">
          <td colspan="1" class="border1"> <?php echo $value['std_name'].' - '.$value['parent_name'];?></td>
          <td colspan="1" class="border1"> <?php echo $value['subject_name'].' - '.$value['teacher_name'];?></td>
          <td colspan="1" class="border1"> <?php echo $value['class_name'].' - '.$value['section_name'];?></td>
          <td colspan="1" class="border1" style="border-right: 1px solid black"> <?php echo $value['amount'];?></td>
          <th></th>
        </tr>
      <?php $x++; }  ?>
      <tr><td colspan="100%"><hr></td></tr>
        <tr>
          <td colspan="2" align="right"><b>Total Amount: </b></td>
          <td colspan="2" align="right"><b>Rs.<?php echo $invoice[0]['tota_fee']; ?></b></td>
        </tr>
        <tr>
          <th class="border_bottom" colspan="100%"></th>
        </tr>
        
      </tbody>
    </table>
  </td>
</tr>
</table>
<div>
<b> Powered by XpertSpot +92-300-2660908</b>
<p style="page-break-after: always"> </p>
</div>
</body>
<script type="text/javascript">
window.print();
</script>