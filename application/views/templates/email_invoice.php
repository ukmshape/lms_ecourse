<html>

<body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
  <table style="max-width:670px;margin:100px auto 100px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px #00aeef;">
    <thead>
      <tr>
        <th colspan="2" style="text-align:center;">
          <a href="http://www.ecourse.ukm.my"><img style="max-width: 80px;padding-right: 20px;" src="cid:<?= $eCOURSE;?>" alt="eCOURSE UKMSHAPE"></a>
          <a href="http://www.ukm.my/ukmshape"><img style="max-width: 280px;padding-right: 20px;" src="cid:<?= $UKMSHAPE;?>" alt="UKMSHAPE"></a>
          <a href="http://www.ukm.my/"><img style="max-width: 130px;" src="cid:<?= $UKM;?>" alt="UKM"></a>
        </th>

        <!--<th style="text-align:left;"><img style="max-width: 80px;" src="cid:<?= $eCOURSE;?>" alt="eCOURSE UKMSHAPE"></th>
        <th colspan="2" style="font-size:14px;padding:50px 15px 0 15px;text-align: center;">
          <a href="http://www.ukm.my/ukmshape"><img style="max-width: 280px;padding-right: 35px;" src="cid:<?= $UKMSHAPE;?>" alt="UKMSHAPE"></a>
          <a href="http://www.ukm.my/"><img style="max-width: 155px;" src="cid:<?= $UKM;?>" alt="UKM"></a>
        </th>-->
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr>
        <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Invoice Date</span><?=date("d F Y", strtotime($detail_pelajar[0]->tarikhinvoice)); ?></p>
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Order status</span><b style="color:orange;font-weight:normal;margin:0">Pending</b></p>
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Invoice no</span> <?=$detail_pelajar[0]->noinvoice;?></p>
          <p style="font-size:14px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Order amount</span> RM <?=number_format((float) $detail_pelajar[0]->total, 2, '.', '');?></p>
        </td>
      </tr>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr>
        <td style="width:50%;padding:20px;vertical-align:top">
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">Name</span> <?=$detail_pelajar[0]->nama;?></p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">NRIC/Passport No</span> <?=$detail_pelajar[0]->nokp;?></p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Phone</span> <?=$detail_pelajar[0]->notel;?></p>
        </td>
        <td style="width:50%;padding:20px;vertical-align:top">
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Email</span> <?=$detail_pelajar[0]->emel;?></p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Address</span> <?=$detail_pelajar[0]->alamat1;?>, <?=$detail_pelajar[0]->alamat2;?> <?=$detail_pelajar[0]->alamat3;?> <?=$detail_pelajar[0]->bandar;?>, <?=$detail_pelajar[0]->negeri;?>, <?=$detail_pelajar[0]->negara;?>, <?=$detail_pelajar[0]->poskod;?></p>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Items</td>
      </tr>
      <tr>
        <td colspan="2" style="padding:15px;">
          <?php foreach ($detail_kursus as $row) { ?>
          <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
            <span style="display:block;font-size:13px;font-weight:normal;"><?=$row->namakursus;?></span> RM <?=number_format((float) $row->unitprice, 2, '.', '');?>
          </p>
          <?php }  ?>
        </td>
      </tr>
    </tbody>
    <tfooter>
      <tr>
        <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;"><center>
          <!--<strong style="display:block;margin:0 0 10px 0;">Regards</strong>--> <b>Micro-credential & Professional Courses Unit</b><br>
          Center for Shaping Advanced & Professional Education (UKMSHAPE)<br>
          Aras 2, Bangunan Wawasan, Universiti Kebangsaan Malaysia, 43600 Bangi, Selangor<br><br>

          <b>Phone:</b> 03552-222011 |
          <b>Email:</b> studymc@ukm.edu.my<br>
          <b>Website: <a href="<?=base_url('/');?>"><?=base_url('/');?></a></b></center>
        </td>
      </tr>
      <!--<tr>
        <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;text-align: center;">
          <a href="http://www.ukm.my/ukmshape"><img style="max-width: 280px;padding-right: 35px;" src="cid:<?= $UKMSHAPE;?>" alt="UKMSHAPE"></a>

          <a href="http://www.ukm.my/"><img style="max-width: 155px;" src="cid:<?= $UKM;?>" alt="UKM"></a>
        </td>
      </tr>-->
    </tfooter>
  </table>
</body>

</html>
