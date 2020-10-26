<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="<?=$path?>transactions/css/all.css">
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet"> 
		<title>INVOICE <?=$title?></title>
	</head>
	<body>
		<div class="wrapper flex-row">
			<div class="l_content">
				<div class="content ">
					<div class="page_info">
						<h1 class="styled">Invoice  <?=$title?></h1>
						<p>DATE: <?=date('d M Y',$time1)?></p>
						<h3>Recipient</h3>
						<?if($list[0]['is_fee']):?>
						<ul>
							<li><strong>MARVLI LTD</strong></li>
							<li>Reg. no.: 12230827</li>
							<li>Address: 20-22 United Kingdom,  Wenlock Road,  <br>London, N1 7GU</li>
							<li>Postcode: 10143</li>
						</ul>
						<ul>
							<li><strong>Bank:</strong> My EU PAY Ltd</li>
							<li><strong>Bank address:</strong> 14 Coach & Horses Yard, Mayfair,<br> London, W1S 2EJ</li>
							<li><strong>BIC:</strong> PYYPGB21</li>
							<li><strong>Account: </strong>GB06PYYP00993910000142</li>
						</ul>  
						<?php elseif($list[0]['acc_from']>0):?> 
							<ul>
								<li><strong><?=$Owner->name?></strong></li>
								<li>Phone: <?=$User->tel?></li>
								<li>Address: <?=$Owner->address?></li>
								<li>Email: <a href="mailto:<?=$User->email?>"><?=$User->email?></a></li>
							</ul> 
							<ul>
								<?php if(strlen($list[0]['to_name'])>0):?><li><strong>Customer Name:</strong> <?=$list[0]['to_name']?></li><?php endif;?> 
								<?php if(strlen($list[0]['to_bic'])>0):?><li><strong>BIC:</strong> <?=$list[0]['to_bic']?></li><?php endif;?>
								<?php if(strlen($list[0]['to_iban'])>0):?><li><strong>Account: </strong><?=$list[0]['to_iban']?></li><?php endif;?>
							</ul>   
						<?php elseif($list[0]['acc_to']>0):?> 
							<ul>
								<li><strong><?=$Owner->name?></strong></li>
								<li>Phone: <?=$User->tel?></li>
								<li>Address: <?=$Owner->address?></li>
								<li>Email: <a href="mailto:<?=$User->email?>"><?=$User->email?></a></li>
							</ul> 
							<ul>
								<?php if(strlen($list[0]['from_name'])>0):?><li><strong>Customer Name:</strong> <?=$list[0]['from_name']?></li><?php endif;?> 
								<?php if(strlen($list[0]['from_bic'])>0):?><li><strong>BIC:</strong> <?=$list[0]['from_bic']?></li><?php endif;?>
								<?php if(strlen($list[0]['from_iban'])>0):?><li><strong>Account: </strong><?=$list[0]['from_iban']?></li><?php endif;?>
							</ul>    
						<?php endif;?> 
			
					</div>
					<table>
						<thead>
							<tr>
								<th>&nbsp;</th>
								<th>Description</th>
								<th>Currency</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
						<?php
						 $total_debit=0;
						 $total_credit=0;
						 $n=0;
						 foreach ($list as $ts):
						 $n++;
						 if ($ts['acc_to']==$Account->id)
						 {
							 $total_debit+=$ts['amount'];
							 $total+=$ts['amount'];
						 }
						 else {
							$total_credit+=$ts['amount'];
							 $total-=$ts['amount']; 
						 }
						  
						 ?>
							<tr>
								<td class="text_green">#<?=$ts['id']?></td>
								<td class="text_green">Transfer from <?=$ts['from_iban']?> <?=$ts['from_name']?>  to <?=($ts['is_fee'] ? 'Marvli LTD' : $ts['to_iban'])?> <?=$ts['to_name']?></td>
								<td class="text_green">EUR</td>
								<td class="text_green"><?=nf(($ts['acc_to']==$Account->id ? '+'.$ts['amount'] : '-'.$ts['amount']),2)?></td>
							</tr>
							<tr class="separator">
								<td colspan="4"></td>
							</tr>
							<?php if (  $ts['is_fee']==0):?>
							<tr>
								<td class="text_muted">Commission:</td>
								<td>Bank card</td>
								<td>EUR</td>
								<td><?=nf($ts['fee'],2)?></td>
							</tr>
							<?php endif;?>
						  <?php endforeach;?>
							<tr class="separator">
								<td colspan="4"></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2" class="text_muted">Current status:</td>
								<td colspan="2">Success</td>
							</tr>
						</tfoot>
					</table>
					<div class="content_footer">
						<span class="px_15">Invoice was created on a computer and is valid without the signature and seal.</span>
					</div>
				</div>
			</div>
			<div class="sidebar">
				<div class="top">
					<div class="text-center logo_s"><img src="<?=$path?>transactions/images/marvli.svg" alt=""></div>
					<p><strong>Marvli LTD</strong>, a company incorporated under the laws of the United Kingdom with registration number: 12230827</p>
					<div class="separator_sidebar"></div>
					<ul>
						<li><strong>BIC/SWIFT: PYYPGB21</strong></li>
						<li><strong>IBAN: GB06PYYP00993910000142</strong></li>
						<li><strong>Bank: My EU PAY Ltd</strong></li>
						<li><strong>Bank address: 14 Coach & Horses Yard, Mayfair, London, W1S 2EJ</strong></li>
					</ul>
				</div>
				<div class="bottom_info">
					<table>
						<tbody>
							<tr>
								<td><img src="<?=$path?>/transactions/images/tel.svg" alt=""></td>
								<td class="text-left">+44 1274 271473 <br> (Mon-Fri 9:00-22:00)</td>
							</tr>
							<tr>
								<td><img src="<?=$path?>/transactions/images/mail.svg" alt=""></td>
								<td class="text-left">support@marvli.com</td>
							</tr>
							<tr>
								<td><img src="<?=$path?>/transactions/images/map.svg" alt=""></td>
								<td class="text-left">60 United Kingdom, St Martins Lane,<br> London, N1 7GU</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div> 
		</div>
	</body>
</html>

  