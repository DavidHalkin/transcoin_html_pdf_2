<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="<?=$path?>transactions/css/all.css">
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet"> 
		<title>Finance charge</title>
	</head>
	<body>
		<div class="wrapper">
			<div class="l_content">
				<div class="content">
					<div class="page_info">
						<h1 class="styled">Account Statement</h1>
						<p>DATE: <?=date('d M Y',$time1)?>-<?=date('d M Y',$time2)?></p>
						<h3>Recipient</h3>
						<ul>
								<li><strong><?=$Owner->name?></strong></li>
								<li>Phone: <?=$User->tel?></li>
								<li>Address: <?=$Owner->address?></li>
								<li>Email: <a href="mailto:<?=$User->email?>"><?=$User->email?></a></li>
						</ul> 
						<ul>
							<li><strong>Bank:</strong> My EU PAY Ltd</li>
							<li><strong>Bank address:</strong> 14 Coach & Horses Yard, Mayfair,<br> London, W1S 2EJ</li>
							<li><strong>BIC:</strong> PYYPGB21</li>
							<li><strong>Account: </strong><?=$Account->iban?></li>
						</ul>
					</div>
					<div class="table_etc">
						<table class="table_top">
							<thead>
								<tr>
									<th>OPENING BALANCE</th>
									<th>CLOSING BALANCE</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?=nf($open_balance,2)?></td>
									<td><?=nf($close_balance,2)?></td>
								</tr>
							</tbody>
						</table>
						<table class="table_info">
							<thead>
								<tr>
									<th>DATE</th>
									<th>DESCRIPTION</th>
									<th class="text-center">DEBIT</th>
									<th class="text-center">CREDIT</th>
									<th>TOTAL</th>
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
									<td><?=date('d.m.Y',$ts['time'])?></td>
									<td>#<?=$ts['id']?> <?=$ts['text']?>
										from <?=$ts['from_iban']?> <?=$ts['from_name']?> to <?=($ts['is_fee'] ? 'Marvli LTD' : $ts['to_iban'])?> <?=$ts['to_name']?></td>
									<td> <?=nf(($ts['acc_to']==$Account->id ? '+'.$ts['amount'] : ''),2)?></td>
									<td class="text_red"> <?=nf(($ts['acc_to']!=$Account->id ? '-'.$ts['amount'] : ''),2)?>  </td>
									<td><?=nf($total,2)?></td>
								</tr>
							 <?php endforeach;?> 
							</tbody>
							<tfoot>
								<tr>
									<th>TOTAL</th>
									<th>&nbsp;</th>
									<th><?=nf($total_debit,2)?></th>
									<th><?=nf($total_credit,2)?></th>
									<th><?=nf($total,2)?></th>
								</tr>
							</tfoot>
						</table>
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
       