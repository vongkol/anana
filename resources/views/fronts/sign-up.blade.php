@extends('layouts.security')
@section('content')
<body class="my-login-page my-sign-up main-page-login">
			<div class="container">
				<div class="row  justify-content-md-center login">
					<div class="card-wrapper ">
						<div class="card box-part fat">
							<div class="card-body">
								<h4 class="card-title">Sign Up</h4>
								<hr>
								@if(Session::has('sms1'))
									<div class="alert alert-danger" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<div>
											{{session('sms1')}}
										</div>
									</div>
								@endif
								@if ($errors->any())
									<div class="alert alert-danger" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif
								<?php
									$countries = DB::table('countries')->orderBy('name')->get();
								?>
								<form method="POST" action="{{url('/member/register')}}" name="frm" id="frm">
									{{csrf_field()}}
									<div class="form-group row">
										<div class="col-md-6">
											<label>
												<strong>Sponsor ID</strong>
												<input type="text" class="form-control border-radius-22" name="sponsor_id" value="{{$sponsor_id}}">
											</label>
										</div>
										<div class="col-md-6">
											<label for="">
												<strong>Full Name<span class="text-danger">*</span></strong>
												<input type="text" class="form-control border-radius-22" required autofocus 
												 name="full_name" id="full_name" value="{{old('full_name')}}">
											</label>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-6">
											<label for="">
												<strong>Username<span class="text-danger">*</span></strong>
												<input type="text" class="form-control border-radius-22" required 
													name="username" id="username" value="{{old('username')}}">
											</label>
										</div>
										<div class="col-md-6">
											<label for="">
												<strong>Email<span class="text-danger">*</span></strong>
												<input type="email" class="form-control border-radius-22" required 
												 name="email" id="email" value="{{old('email')}}">
											</label>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-6">
											<label for="">
												<strong>Phone<span class="text-danger">*</span></strong>
												<input type="text" class="form-control border-radius-22" required 
													name="phone" value="{{old('phone')}}" id="phone">
											</label>
										</div>
										<div class="col-md-6">
											<label for="">
												<strong>Country<span class="text-danger">*</span> </strong>
												<select name="country" id="country" class="form-control border-radius-22">
													@foreach($countries as $c)
														<option value="{{$c->name}}" {{$c->name=='Cambodia'?'selected':''}}>{{$c->name}}</option>
													@endforeach
												</select>
											</label>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-6">
											<label for="">
												<strong>Password <span class="text-danger">*</span> </strong>
												<input type="password" class="form-control border-radius-22" 
												 name="password" id="password" required value="{{old('password')}}">
											</label>
										</div>
										<div class="col-md-6">
											<label for="">
												<strong>Confirm Password <span class="text-danger">*</span> </strong>
												<input type="password" class="form-control border-radius-22" name="cpassword" 
													id="cpassword" required>
											</label>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-12">
											<label for="">
												<strong>Security PIN <span class="text-danger">*</span> </strong>
												<input type="password" class="form-control border-radius-22" 
												 name="security_pin" id="security_pin" required value="{{old('security_pin')}}">
											</label>
										</div>
									</div>
								
									<div class="form-group no-margin">
										<!-- <button type="button" class="btn btn-learn btn-warning border-radius-22 btn-block" data-toggle="modal" data-target=".bd-example-modal-lg">
											Continue
										</button> -->
										<button type="button" class="btn btn-learn btn-warning border-radius-22 btn-block" id="mybtn">
											Continue
										</button>
										<!-- <button type="submit" class="btn btn-learn btn-dark btn-block">
											Signup Now
										</button> -->
									</div>
									<div class="margin-top20 text-center">
										Already have an account? <a href="{{url('sign-in')}}">Login</a>
									</div>
								</form>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<h2 class="text-danger text-center">Ana Lee Capital (ALC)</h2>
			<h4 class="text-primary">
				1. Scope of the Terms and Definitions
			</h4>
			<p class="text-justify">
				These General Terms and Conditions ("Conditions") apply to all current and future relationships between 
				Ana Lee Capital and its current members, subsidiaries and/or sister companies (all "ALC"), 
				and you as the user of any of the services, 
				products and (Internet) services (all generally "Products and services" and or "services" offered by ALC).
			</p>
			<p class="text-justify">
				Before you can obtain or use products and services offered by ALC, you must read all the provisions 
				of these Terms and Conditions and agree to these Terms and Conditions in their entirety and all other 
				regulations mentioned therein.
			</p>
			<h4 class="text-primary">2. Additional Rules</h4>
			<p class="text-justify">
				In addition to these terms and conditions, the other terms, policies, restrictions or rules apply as 
				shown by ALC for their products and services on their websites.
			</p>
			<h4 class="text-primary">
				3. ALC version and change reservation
			</h4>
			<p class="text-justify">
				These terms and conditions are the current ones and replace all previous terms and conditions of ALC.
			</p>
			<p class="text-justify">
				ALC reserves the right to change these terms and conditions at any time. Adjustments will be communicated to you in a suitable manner, in particular by means of corresponding publications on the ALC websites, in particular through the introduction of the new terms and conditions.
			</p>
			<p class="text-justify">
				Significant changes to these terms and conditions will be announced to you at least 30 days before their entry into force on the websites operated by the ALC. If you do not object within these 30 days, then this is your agreement to all of the changes to these terms and conditions. If you do object, you are free to cancel your membership with ALC.
			</p>
			<p class="text-justify">
				You have the opportunity at any time to view these terms and conditions in their current version via the ALC websites.
			</p>
			<h4 class="text-primary">
				4. Intellectual property and rights of use
			</h4>
			<p class="text-justify">
				The intellectual property, all copyrights and usage rights, trademarks, images, logos, information and other resources as well as similar rights to the products and services distributed by ALC, their software, the wallet as well as Ana Lee Coin (ALC) etc. remain in any case (eg, also with a purchase of ALC’s, with the use of the exchange platforms, the Wallets, etc.) with the ALC.
			</p>
			<p class="text-justify">
				To the extent that you legally download or use the Software on your computer, device, or other platform as part of the purchase and use of ALC's products and services, or utilize the online platform, ALC grants you a revocable, non-exclusive, non-transferable and non-sub licensable free and limited license to use this software in accordance with these terms and conditions and the additional rules applicable to the product or service, for the sole use of you. You may not sell, rent, lend or otherwise make these rights of use available to any other person. You must keep the Software in its delivered condition and may not modify, reproduce, distribute, display, publish, reverse engineer or otherwise influence it in any way.  If ALC should rely on you for the provision of its products and services for intellectual property rights or other intellectual property rights, you grant ALC a free and limited right of use for the purpose of the service rendered by ALC and for the duration necessary for service provision.
			</p>
			<h4 class="text-primary">
				5. ALC as a cryptocurrency
			</h4>
			<p class="text-justify">
				ALC offers the "ALC", (ALC) a crypto currency (virtual currency). ALC offers this "coin" and provides services for the ALC. 
			</p>
			<p class="text-justify">
				The ALC wallet internally verifies and seals all transactions made with ALC and thus ensures the correct allocation and recognition of the ALC to the users of the services offered by the ALC. You have no right to the release or storage of ALC or equivalent as a matter.
			</p>
			<p class="text-justify">
				The ALC is considered a cryptocurrency. However, you have no legal claim against any person or institution for payment of ALC unless you have a dispute with a 3rd party vendor who accepts ALC; in which case, ALC is hereby indemnified from any action. ALC does not give anyone a right to convert ALC into money. It is only able to be exchanged payment for real estate, merchants cooperated with ALC, and casino. ALC also makes no representations or warranties regarding the value, the expectation of value and/or the value of ALC’s; although it does present a speculative valuation in marketing materials based on ALC’s payment operations, other operations being developed in the future, as well as the comparison to Bitcoin. ALC does not in any way guarantee any future valuation of ALC.
			</p>
			<h4 class="text-primary">
				6. No deposits with ALC / No bank, trusteeship or administration
			</h4>
			<p class="text-justify">
				ALC is considered cryptocurrency, and ALC is not a registered and regulated bank. It is a Self-Regulated Organization. None of the services offered by ALC, in particular not in connection with the ALC and the processing of transactions with ALC, implies that at any time you have a "deposit" or a deposit account at ALC within the meaning of banking legislation.
			</p>
			<p class="text-justify">
				You recognize that ALC is not a bank, and that its products and services are not banking services. You acknowledge that ALC is not acting as your trustee or asset manager.
			</p>
			<h4 class="text-primary">
				7. Transactions and transaction restrictions
			</h4>
			<p class="text-justify">
				On its online platforms, in particular www.analeecapital.com, ALC provides only the software or platform and thus the processing service with which you can register transactions for processing in the wallet. The logged-in transactions are processed by the internal wallet in an automatic process. This process is pre-programmed and protected against any interference. This ensures every transaction is correctly verified and sealed. ALC can therefore not intervene in this process. It also cannot undo wallet verified and sealed transactions.
			</p>
			<p class="text-justify">
				In the case of transactions entered incorrectly by you, namely erroneous transfers, you can contact the ALC in writing or by email : support@analeecapital.com. This will inquire whether the recipient of the erroneous transaction agrees to a voluntary return transfer. If he does not, ALC will provide you with the contact details of the recipient so that you can contact him or work backwards. ALC has no further obligations in this process.
			</p>
			<p class="text-justify">
				ALC does not handle transactions and payments, ALC does not hold and manage funds from you and third parties in the various wallets, ALC only provides access to the wallet. ALC is not involved in the settlement of payment transactions and payment processes of the parties involved. ALC does not guarantee a specific processing time for transactions. ALC does however utilize the MLM member funds to buy and manage operations for its member benefits.
			</p>
			<p class="text-justify">
				ALC is under no obligation to monitor or verify the transactions in or through ALC or any other currency on these platforms. You are responsible for transactions in ALC or other currencies entered by you on a platform operated by ALC. ALC is responsible for technical errors and issues and will work in an expeditious manner to correct such issues if they arrive.
			</p>
			<p class="text-justify">
				Due to regulatory conditions, transfer restrictions and/or prohibitions may exist or become necessary in the future. Please note that in such a case ALC products and services are only limited or no longer available. You acknowledge this risk and release ALC from any direct and indirect liability and responsibility associated therewith.
			</p>
			<h4 class="text-primary">
				8. Data security
			</h4>
			<p class="text-justify">
				ALC designs its products and services to the best of its ability and according to the current state of the art (best effort).
			</p>
			<p class="text-justify">
				However, information technology is never completely secure. Attacks and manipulations of all kinds are possible, both on ALC systems and on your systems or those of third parties. Conceivable are, inter alia, hacker attacks, virus attacks, fishing and phishing, mining attacks, etc., but also power cuts or the like. You acknowledge this risk and release ALC from any direct and indirect liability and responsibility associated therewith.
			</p>
			<p class="text-justify">
				You are obliged to inform ALC immediately if you have been the victim of a computer attack and ALC products or services are affected or may be affected. 
			</p>
			<h4 class="text-primary">
				9. Identification
			</h4>
			<p class="text-justify">
				ALC attaches great importance to correctly identifying the users of its platforms for transactions with ALC’s and the beneficial owners behind any users. ALC uses different identification methods.
			</p>
			<p class="text-justify">
				You are obliged to provide ALC with all information requested at the time of registration or later about your identity, confirmation of residency, and your economic circumstances. In particular, you are obliged to provide ALC with standard Know Your Customer (KYC) documents; State Issued identification, a copy of a current consumer bill (gas, electricity, telephone, etc.), corporate accounts must provide all registration documents and certified declaration of the beneficial ownership.
			</p>
			<p class="text-justify">
				In the event of changes to the information provided, you are obliged to notify ALC of any changes in writing right away. You also authorize ALC to obtain from you and from third parties with all other information which ALC considers necessary for the proper identification of your person, stay and economic circumstances.
			</p>
			<p class="text-justify">
				In general, ALC must be sure the information submitted to it is correct, unless ALC is informed that information is flawed, unauthorized or falsified. You are responsible for the truth and completeness of the identification data.
			</p>
			<p class="text-justify">
				ALC is not obliged to accept you as a user. ALC may terminate the relationship with you at any time, refuse to create, activate, or adapt a user profile, and ALC may block or delete user profiles at any time if it believes you or a third party is violating its obligations under these terms or other legal or moral obligations. The provision of false information may also constitute a criminal offense. 
			</p>
			<h4 class="text-primary">	
				10. Prohibition of trusteeship
			</h4>
			<p class="text-justify">
				You may acquire and use all ALC products and services exclusively and for your own account. In particular, you are required to use your access data only for yourself, not to disclose it to any other person and to secure it in such a way that other persons cannot be aware of it. You may not register transactions in ALC or other cryptocurrencies on a fiduciary basis or as a straw person for others.
			</p>
			<h4 class="text-primary">
				11. Protection of access authorization 
			</h4>
			<p class="text-justify">
				You are responsible for the protection of your access data for all ALC products and services. Misuse of your access rights can lead to misallocation of products and services, including unwanted transactions and loss of ALC’s and other cryptocurrencies. Transactions may be executed incorrectly, late or not at all. You acknowledge this risk and release ALC from any direct and indirect liability and responsibility associated therewith.
			</p>
			<h4 class="text-primary">
				12. Privacy Policy
			</h4>
			<p class="text-justify">
				ALC complies with the Singapore Data Protection Act. You authorize ALC to use your data (including IP addresses, profile information, name, address, telephone numbers, email addresses, date of birth, contacts, browser type, computer behavior, contents of the various wallets, transactions, etc.) for the purposes of administration, Customer Service, combating money laundering, compliance, auditing, security and all other purposes in connection with your use of the services offered by ALC. ALC may use cookies to identify your preferences and to adjust their offers accordingly.
			</p>
			<p class="text-justify">
				You have the right at any time to request information from ALC on the personal data you have processed and, if proved with the necessary evidence, its correction or updating.
			</p>
			<p class="text-justify">
				ALC will neither sell your data for marketing purposes nor make it available to others without your permission.
			</p>
			<p class="text-justify">
				ALC's wallet and thus all transactions in ALC are transparent, i.e. publicly visible and comprehensible. They take note of the fact that anyone can recognize when and how many ALC’s were and are assigned to which wallets. You acknowledge that any person who has, for example, provided you with the identification of your wallet during a transaction, can keep track of how many ALC’s are assigned to their wallet and what transactions you make with them. You agree and acknowledge that this information about your Wallet cannot be blocked. If you do not agree, you should not use ALC products and services.
			</p>
			<p class="text-justify">
				If you are the recipient of alleged faulty transfers, ALC may contact you at the request of a third party.  If no amicable agreement is reached between you and the third party spokesman, ALC is authorized to provide your data, name and surname, and address. They accept it with approval.
			</p>
			<p class="text-justify">
				ALC cannot guarantee comprehensive data protection. ALC points out that for technical reasons, eg, when transmitting information (for example, when transmitting an unencrypted or insufficiently encrypted email), it is not possible to ensure comprehensive data protection. When switching to external websites, ALC's privacy policy does not apply, but those of the respective website. In particular, ALC is also entitled to transfer all data from you to the competent authorities, auditors and private individuals in Cambodia and abroad, in particular in the case of criminal, civil and / or administrative proceedings of any kind.
			</p>
			<h4 class="text-primary">
				13. Comments and opinions
			</h4>
			<p class="text-justify">
				ALC does not tolerate offensive behavior. If ALC products and services are provided with your comments or opinions, you are solely responsible. ALC is not responsible and accepts no liability for any of your comments or opinions. ALC is entitled, but not obliged, to immediately delete unlawful or indecent comments and opinions without prior warning.
			</p>
			<h4 class="text-primary">
				14. Links / shortcuts
			</h4>
			<p class="text-justify">
				ALC websites or general services and products may contain links to websites and sources of third parties. A link does not mean that ALC confirms or is in any way related to the sources and content. ALC is not responsible for the type and content of the linked websites. You use all links and the contents of the resulting websites at your own risk and release ALC from any related direct and indirect liability and responsibility.
			</p>
			<h4 class="text-primary">
				15.   Violations of laws and regulations / notification to authorities
			</h4>
			<p class="text-justify">
				If there is a reasonable suspicion that you have violated existing domestic or foreign laws and / or other regulations in connection with ALC's products and services, ALC is entitled to report this to the competent authorities.
			</p>
			<p class="text-justify">
				In such cases, ALC is entitled, excluding all indemnification from you, to block all of your products and services immediately and without prior notice and to break off the business relationship with you.
			</p>
			<p class="text-justify">
				In such cases, ALC is entitled to cooperate with the competent authorities, ensuring full transparency, especially with regard to personal data.
			</p>
			<h4 class="text-primary">16.   Offers / conclusion of Contract </h4>
			<p class="text-justify">
				ALC websites do not contain a binding offer for products and services. All offers are non-binding and without obligation. Your order is considered a binding offer. You agree to provide truthful information about your orders.
			</p>
			<p class="text-justify">
				ALC is not obliged to enter into business relations of any kind with you. ALC may refuse to enter into new business or continue existing business relationships with you without stating reasons.
			</p>
			<h4 class="text-primary">17.   Your right to rescind your online order</h4>
			<p class="text-justify">
				ALC grants you a right of withdrawal as a bank and member of the MLM. If you wish to withdraw ROI bonus, you must declare to ALC in writing or by e-mail no more than 30 days after ROI and receiving your ROI bonus ten (10) days prior to withdrawal request. The revocation must be sent to email address support@analeecapital.com.  If the conditions of the withdrawal are met, ALC will release by ALC.
			</p>
			<h4 class="text-primary">18.   Legal and regulatory framework</h4>
			<p class="text-justify">
				ALC is a company domiciled in Cambodia and is subject to Cambodia law. It complies with the legal and regulatory requirements applicable in Cambodia when providing its Internet services. It also does everything reasonable to ensure that its Internet services are not offered in countries whose jurisdiction does not permit their use.  However, it is your own responsibility to ensure that you do not violate your country's laws by using ALC Internet Services.
			</p>
			<p class="text-justify">
				When using ALC products and services and associated items, you are prohibited from <br>
			(a) violating the provisions of these ALC or other regulations published by ALC on its websites <br>
			(b) violating any applicable law <br>
			(c)    using ALC's products and services to promote or conclude transactions that violate applicable law, including, but not limited to, the trading of goods that are prohibited from trading, the exchange of data, media or information, if it infringes the rights of third parties or the use of prohibited or criminal services <br>
			(d)    using ALC's products and services to disguise the origin or the eligibility of assets <br>
			(e)    seeking or securing an undue advantage by using ALC products and services <br>
			(f)     disclosing data of another user to third parties, to pass them on to third parties or to use them for marketing purposes, unless the other user has expressly consented to this <br>
			(g)    using ALC's products and services as a straw man, trustee or equivalent for the account and benefit of a third party <br>
			(h)    disclosing your access data to a third party or failing to secure it in such a way that no third party can recognize it <br>
			(i)     allowing the intrusion of malware or spyware <br>
			(j)     using technical devices or software to interfere, monitor or duplicate the websites operated by ALC. 
			</p>
			<p class="text-justify">
				In addition, you agree not to use ALC's Internet services in or from countries where ALC does not support these services.
			</p>
			<p class="text-justify">
				If you violate these obligations ALC is entitled immediately and without prior notice to suspend your accounts, and/or break off the business relationship with you, and/or block your access to wallet. In such a case, you can no longer use all of ALC's products and services and your tokens, ALC’s and other cryptocurrencies expire without compensation. You are also obliged to compensate ALC for the damage caused by the prohibited use.
			</p>
			<p class="text-justify">
				ALC and its products and services may be affected by changes in the legal and regulatory framework in Cambodia or abroad. This may mean that ALC can no longer provide its products and services to the same extent or even no longer at all. You acknowledge this risk and release ALC from any direct and indirect liability and responsibility associated therewith.
			</p>
			<h4 class="text-primary">19.   Change of products and services</h4>
			<p class="text-justify">
				ALC is a start-up company. There is a possibility that in the future existing products and services will change in whole or in part, be eliminated, be replaced by new ones and that entirely new products and services will be added. You acknowledge this risk and release ALC from any direct and indirect liability and responsibility associated therewith. However, ALC has acquired assets that have value and believes that its business plan is sustainable. 
			</p>
			<h4 class="text-primary">20.   Technical specifications</h4>
			<p class="text-justify">
				ALC does not guarantee or warrant for any particular property of its products or services. Technical data, specifications and performance specifications in all previous, current and future documents (hardcopy or online) are solely for the purposes of the specifications, are subject to change and can be changed at any time without any claims from you. 
			</p>
			<h4 class="text-primary">21.   Failure to meet expectations</h4>
			<p class="text-justify">
				There is a risk that the expectations of the market in general, of third parties or of yourself regarding ALC products and services will not be fulfilled and/or there is only insufficient interest in ALC's products and services. You acknowledge this risk and release ALC from any direct and indirect liability and responsibility associated therewith.
			</p>
			<h4 class="text-primary">22.   Imitation</h4>
			<p class="text-justify">
				There is a risk that legal entities or natural persons who are not related to ALC may imitate their products and services. This can have a negative impact on ALC's products and services and even lead to the cessation of ALC's business activities. You acknowledge this risk and release ALC from any direct and indirect liability and responsibility associated therewith.
			</p>
			<h4 class="text-primary">23.   Place of performance</h4>
			<p class="text-justify">
				The obligations arising from the relationships between ALC and you must be fulfilled by both parties at ALC's headquarters. 
			</p>
			<h4 class="text-primary">
				24.   Use of vicarious agents
			</h4>
			<p class="text-justify">ALC is entitled to render its services through assistants, vicarious agents, subcontractors, etc.</p>
			<h4 class="text-primary">25.   Transfer</h4>
			<p class="text-justify">
				ALC is entitled to transfer all or part of its rights and obligations arising from its relations to affiliated companies.
			</p>
			<p class="text-justify">
				If you wish to transfer your rights and obligations from the relationships with ALC to other legal or natural persons, you must obtain prior written consent from ALC.
			</p>
			<h4 class="text-primary">26.   Termination of the business relationship</h4>
			<p class="text-justify">
				For the cancellation of puttable products and services from ALC, the respective special termination provisions apply, which are listed on the ALC websites and in the special descriptions of the products and services.
			</p>
			<p class="text-justify">
				In addition, you have the right at any time to terminate your business relationship with ALC in writing or by email and to have your accounts deleted. In such a case, you can no longer use all of ALC's products and services and your tokens, ALC’s and other cryptocurrencies expire without further compensation.  ALC is further entitled to store, process and use your data for the statutory and contractual obligations of ALC.
			</p>
			<h4 class="text-primary">27.   Violation of the Terms and Conditions and termination of business relations</h4>
			<p class="text-justify">
				If you violate the provisions of these terms and conditions or any other legal or moral obligations and wherever it specifically provides for these terms and conditions, ALC is entitled immediately and without prior notice to block your accounts, usage profiles, etc., and/or terminate the business relationship with you and/or block your access to the platform and wallet.
			</p>
			<p class="text-justify">
				In such a case, you can no longer use all of ALC's products and services and your tokens, ALC’s and other cryptocurrencies expire without compensation. ALC is further entitled to store, process and use your data for the statutory and contractual obligations of ALC.
			</p>
			<p class="text-justify">
				Finally, you are obliged to compensate ALC for the damage resulting from the infringement.
			</p>
			<h4 class="text-primary">28.   Termination of ALC's business activities</h4>
			<p class="text-justify">
				ALC reserves the right to discontinue business activities and all products and services with a notice of thirty (30) days. In such a case the source code of ALC's platform or wallet is released and all participants in the bonus payment traffic can continue to use their ALC’s independently of ALC. This ensures that payment transactions with MLM members continue to function even if ALC no longer exists.
			</p>
			<h4 class="text-primary">29.   Liability, warranty and indemnity </h4>
			<p class="text-justify">
				You use ALC's products and services at your own risk and responsibility. ALC excludes contractual as well as non-contractual liability and responsibility for all damage as far as legally permissible, which you suffer as a result of your interaction with ALC and/or its organs, employees, consultants, agents and other exponents and/or through the products and services. Thus claims for damages of any kind are excluded both against ALC and against the named persons.
			</p>
			<p class="text-justify">
				You agree to indemnify, defend and indemnify ALC and its organs, employees, consultants, agents and other exponents against any claim, liability, obligation to pay damages or all costs of third parties (including legal fees) resulting from your use of ALC products and services. ALC reserves the right to participate in the judicial and administrative proceedings at its own expense.
			</p>
			<h4 class="text-primary">30.   Force majeure</h4>
			<p class="text-justify">
				ALC is not liable for events of force majeure, which make the performance of ALC products and services considerably more difficult or temporarily or permanently obstruct impossible, or make the services and products impossible. Force majeure includes all circumstances beyond the will and influence of the parties, such as natural disasters, government action, authority decisions, blockades, war and other military conflicts, mobilization, civil unrest, terrorist attacks, strikes, lockouts and other labor disputes, seizure, embargo or other circumstances.
			</p>
			<h4 class="text-primary"> 31.   Language</h4>
			<p class="text-justify">
				English is the relevant language in the legal relationship between ALC and you. If contractual documents, including these Terms and Conditions, are written in several languages, the English version shall prevail in case of doubt.
			</p>
			<h4 class="text-primary">32.   Severability clause</h4>
			<p class="text-justify">
				Should individual provisions of these Terms and Conditions be ineffective or unenforceable, or subsequently become ineffective or unenforceable, this shall not affect the validity of the remaining terms and conditions. The invalid or unenforceable provision shall be replaced by a valid and enforceable provision that approximates as closely as possible the objective sought by the contractual parties through the invalid or unenforceable provision. This regulation also applies mutatis mutandis to any gaps in the terms and conditions.
			</p>
			<h4 class="text-primary">33.   Applicable law</h4>
			<p class="text-justify">
				All legal relationships between the ALC and you are subject exclusively to Cambodia law to the exclusion of international private law.
			</p>
			<h4 class="text-primary">34.   Place of jurisdiction</h4>
			<p class="text-justify">
				Should a legal dispute arise between you and ALC, we recommend that you contact ALC first so that a friendly solution can be found.
			</p>
			<p class="text-justify">
				All disputes or disagreements in connection with your relationship with ALC shall be settled by arbitration in accordance with the Cambodian Rule. The version of the Rules of Arbitration in effect at the time of serving the notice of initiation shall apply. The arbitral tribunal shall consist of one member. The seat of arbitration shall be in Phnom Penh. The language of the arbitration court is Khmer, and evidence documents in English can be submitted with translation. 
			</p>
			<h4 class="text-primary">35.   Contact/Address</h4>
			<p class="text-justify">
				Unless expressly stated otherwise, all declarations of intent and notifications must be sent to ALC in writing by email to support@analeecapital.com. 
			</p>
			<p>
				<strong class="text-primary">Ana Lee Capital</strong>
			</p>
			<p style="font-weight:bold;font-size:15px">
				<label for="ch1">
					<input type="checkbox" id="ch1" name="ch1"> I have read and agreed.
				</label>
			</p>
		</div>
		<div class="modal-footer text-left">
			<button type="button" class="btn btn-warning" data-dismiss="modal" id="btn" disabled>Confirm Registration</button>
		</div>

		</div>
	</div>
</div>


@endsection
@section('js')
	<script>
		window.onload = function(){
			let btn = document.querySelector('#mybtn');
			btn.addEventListener('click', function(){
				let full_name = document.querySelector('#full_name').value;
				let username = document.querySelector('#username').value;
				let email = document.querySelector('#email').value;
				let phone = document.querySelector('#phone').value;
				let password = document.querySelector('#password').value;
				let cpass = document.querySelector('#cpassword').value;
				let pin = document.querySelector('#security_pin').value;
				
				if(full_name=="")
				{
					alert("Full Name is required!");
				}
				else if(username==''){
					alert('Username is required!');
				}
				else if(email=='')
				{
					alert('Email is required!');
				}
				else if(phone=='')
				{
					alert('Phone is required!');
				}
				else if(password=='')
				{
					alert('Password is required!');
				}
				else if(cpass=='')
				{
					alert('Confirm Password is required!');
				}
				else if(pin=='')
				{
					alert('Security PIN is required!');
				}
				else if(password!=cpass)
				{
					alert('Password and Confirm Password is not matched!');
				}
				else{
					$('#modal').modal('show');
				}
			});
		};
		$(document).ready(function(){
			$("#btn").click(function(){
				$("#frm").submit();
			});
			$("#ch1").change(function(){
			
				if($("#ch1").prop('checked'))
				{
					$("#btn").removeAttr("disabled");
				}
				else{
					$("#btn").attr("disabled","disabled");
				}
			});
		});
	</script>
@stop