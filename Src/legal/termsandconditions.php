<?php 
/* Copyright (C) DwarvenKnowledge, LLC - All Rights Reserved
 * This product is licensed to a single organization or user and must not be distributed
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 */
?>
<?php

// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('../libraries/password_compatibility_library.php');
}

// include the config
require_once('../config/config.php');

// include the PHPMailer library
require_once('../libraries/PHPMailer.php');

// load the login class
require_once('../classes/Login.php');

$login = new Login();

if ($login->isUserLoggedIn() == false) {
	//header('Location: http://www.scriptencryption.com/account/login.php');
	//die();
}

//home page?

?>

<?php 
	
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/nav-bar.php');	
	//Everything is inside pagewrapper
?>

<?php 

	$db_Ratings = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
			
	$db_Ratings->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db_Ratings->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
	$statement_Ratings = null; //The statement	
			
	try {
		$statement_Ratings = $db_Ratings->prepare('SELECT termsandconditions FROM server_termsandconditions');			
	} catch (PDOException $e) {	
		header("Location: http://www.scriptencryption.com/error/404.php?error=2"); //Error code 1146 - unable to find database. //return 'Internal_Server_Error'; //Error.
		die();
	}
			
	try {
		$statement_Ratings->execute();
	} catch (PDOException $e) {				
		header("Location: http://www.scriptencryption.com/error/404.php?error=3"); //Error code 23000 - unable to to create because of duplicate id. //return 'Error_Try_Again'; //Error.
		die();
	}		

	$result_Ratings = $statement_Ratings->fetch();
				
				
				//<?php echo $result_Ratings['termsandconditions']; ?>
?>



<div class="container_12 backgroundwhite">
	<div class="grid_12" style="padding-top:0px;">
		<label for="long_description"><b>The terms and conditions:</b></label>	
			
			<textarea readonly rows="0" cols="50" id="long_description" name="long_description" type="text" class="textbox" style="resize: none;width:938px;height:500px;">Terms of Use

	Please read these terms of use carefully before using the website and services offered by Dwarven Knowledge LLC, and its subsidiaries (collectively, “Fleecefinder”). This agreement sets forth the legally binding terms and conditions for your use of the website at www.fleecefinder.com (the “Site), and services provided by Fleecefinder (collectively, the “Services”). 
	By using the Services in any manner, including but not limited to visiting or browsing the Site, you (the “user” or “you”) agree to be bound by this Agreement, including any additional terms and conditions and policies referenced here and/or available by hyperlink. This agreement applies to all users of the Services, including but not limited to users who are vendors, customers, merchants, contributors of content, information and/or other materials or services on the Site. 
	If you have any questions please refer to the Help section or Contact Us. 
	
1.	Fleecefinder is a venue
This means that Fleecefinder allows users, who comply with Fleecefinder’s policies, to sell and buy certain goods within a fixed price format. Fleecefinder is not directly involved in the transaction between buyers and sellers, and as a result, Fleecefinder has no control over the quality, safety, morality or legality of any part of the listed item, the truth and accuracy of the item’s listing, the ability of the sellers to sell the item or the ability of the buyers to pay. Users are not pre-screened (except for services that require it) or the content and/or the information provided by the user. This means that Fleecefinder cannot ensure that the transaction will actually be completed by the buyer or the seller. 
	Because of this Fleecefinder does not transfer legal ownership of the items from the seller to the buyers. 
	Fleecefinder also doesn’t guarantee the true identity, age, or nationality of a user, and encourages you to message potential transaction partners through the Site’s messaging system. 
	You agree that Fleecefinder is a venue and as a venue is not responsible or liable for any the content (for example: data, text, information, usernames, graphics, images, photographs, profiles, audio, video, items, and links posted on the Site). You use Fleecefinder at your own risk. 

2.	Who is eligible to be a member
Age: You must be at least 18 years old, and be able to form a legally binding contract under applicable law, to use the services provided by this Site. You represent and warrant that all registration information submitted, including your age being over 18 years, is accurate and truthful. Fleecefinder reserves the right to, at its sole discretion, to refuse access or use of service to any person or entity and to change the eligibility criteria at any time. This provision is void where prohibited by law and the right to access the Services is revoked in the jurisdictions. 
	If you are under 18 years old you may use Fleecefinder’s services in conjunction with and under the supervision of a parent or legal guardian who is at least 18 years old, and the adult is the user and is completely responsible for any and all activities. 
Compliance: You agree to comply with all local laws regarding online conduct and acceptable content. You are responsible for all applicable taxes. In addition, you must abide by Fleecefinder’s policies as stated in the Agreement and the policy documents (if applicable to your use of the Site) as well as all other operating rules, policies and procedures that may be published on the Site by Fleecefinder, which is then incorporated herein by reference and each of which may be updated by Fleecefinder without notice to you. 
Privacy Policy
	In addition, some services offered by Fleecefinder may be subject to additional terms and conditions promulgated by Fleecefinder from time to time; your use of such services is subject to those additional terms and conditions, which are incorporated into this agreement by reference. 
	Password: Fleecefinder strongly recommends that you don’t share your password with anyone. You are completely responsible for all activity, liability and damages resulting from your failure to keep your password confidential. You agree to immediately notify Fleecefinder of any unauthorized use of your password, account or breach of security. You also agree that Fleecefinder cannot and will not be liable for any loss or damage arising from your failure to keep your password confidential. You agree not to provide your username and password information in combination to any other party other than Fleecefinder without Fleecefinder’s express written permission. 
	Account Information: You must keep your account information up-to-date and accurate at all times, including a valid email address. To sell items on Fleecefinder you must provide and maintain valid payment information with a PayPal account. 
	Account Transfer: You may not transfer or sell your Fleecefinder account or user ID to another party, and you are responsible for all activity. If you are registering as a business entity, you personally guarantee that you have the authority to bind the entity to this Agreement. 
	Right to Refuse Service: Fleecefinder reserves the right to refuse service, at its sole discretion, at any time, for any reason. Fleecefinder’s services are not available to temporarily or indefinitely suspended users. 
3.	Fees and Billing
It is free to join and set up a shop on Fleecefinder, but fees are charged when you list an item for sale and a percentage of the sale price of the item when it sells. You will have a chance to review the listing and accept the fees that you will be charged before the item is listed on the website. Fleecefinder’s fees policy, which is subject to change, is incorporated into this Agreement by reference. Any changes to the Fees Policy and the fees are effective after Fleecefinder provides at least (14) days’ notice by posting the changes on the Site. Fleecefinder reserves the right to temporarily change the Fees Policy and the fees for promotional events (i.e. free listing days); such changes are effective when Fleecefinder posts the temporary promotional event on the Site. Fleecefinder may, at Fleecefinder’s sole discretion, change some or all of Fleecefinder’s services at any time. In the event Fleecefinder introduces a new service, the fees for that service are effective at the launch of the service. Unless otherwise stated all fees are quoted in US dollars (USD). 
	In certain situations, including but not limited to a void or invalid transaction, Fleecefinder may issue a credit for the applicable fees to a seller’s billing statement. 
	You are responsible for paying all fees and applicable taxes associated with using Fleecefinder. Please refer to Fleecefinder’s Billing Policy for more information. Fleecefinder will send an invoice to the seller’s email address on file detailing the amount due for the prior month’s fees and charges. The seller must pay the amount due in full within 15 days of the date of invoice, or the account will be considered past due. 
	Fees and Termination: If Fleecefinder terminates a listing or your account, if you close your account, or if the payment of your Fleecefinder’s fees cannot be completed for any reason, you remain obligated to pay Fleecefinder for all unpaid fees plus any penalties, if applicable. If the seller’s account is not paid in full and becomes past due, the seller risks penalties such as the suspension of privileges and/or termination of the account and other collection mechanisms (including retaining collection agencies and legal counsel). If you have a question or wish to dispute a charge, contact Fleecefinder. 
4.	Listing and Selling
Listing Description: All listings on Fleecefinder must be for sale. By listing an item on the Site you warrant that you and all aspects of the item comply with Fleecefinder’s published policies. You also warrant that you may legally sell the item. You must accurately describe your item and all terms of sale in your Fleecefinder shop. Your listings may only include text descriptions, graphics, pictures and other content relevant to the sale of that item. All items must be listed in an appropriate category with appropriate tags. Each listing must accurately and completely describe the item/items for sale in that listing. If the “in stock” quantity is more than one, all items in that listing must be identical. Each unique item must have its own listing. 
Shop Policies: All sellers are urged to outline shop policies for their Fleecefinder shop. These policies may include, for example, shipping, returns, payment and selling policies. Sellers must create reasonable policies in good faith and must abide by such policies. All shop policies must comply with Fleecefinder’s sitewide policies. Sellers are responsible for enforcing their own reasonable shop policies. Fleecefinder reserves the right to request that a seller modify a shop policy. 
Binding Sale: Sellers are responsible for accurately listing their items, and buyers are responsible for reading the description of items before making a purchase. All sales are binding. The seller is obligated to ship the order or otherwise complete the transaction with the buyer in a prompt manner, unless there is an exceptional circumstance, such as (a) the buyer fails to meet the terms of the seller’s listing, or (b) the seller cannot authenticate the buyer’s identity. The buyer is obligated to deliver appropriate payment for items purchased, unless there is an exceptional circumstance. 
Fee Avoidance: The price stated in each listing description must be accurate representation of the sale. Sellers may charge reasonable shipping and handling fees to cover the costs for packaging and mailing the items. Sellers may not charge excessive shipping fees or otherwise avoid fees. You may not alter the item’s price after the sale for the purpose of avoiding Fleecefinder’s transaction fees, misrepresenting the item’s location, or using another user’s account without permission. 
5.	Prohibited, Questionable, and Infringing Items and Activities
You are solely responsible for your conduct and activities on and regarding Fleecefinder and any and all data, text, information, usernames, graphics, images, photographs, profiles, audio, video, items, and links (together, “Content”) that you submit, post, and display on Fleecefinder. 
Restricted Activities: Your Content and your use of Fleecefinder shall not:
•	Be false, inaccurate or misleading.
•	Be fraudulent or involve the sale of illegal, counterfeit or stolen items.
•	Infringe upon any third-party’s copyright, patent, trademark, trade secret or other proprietary or intellectual property rights or rights of publicity or privacy
•	Violate this Agreement, or any site policy or community guidelines, or any applicable law, statute, ordinance or regulation (including, but not limited to, those governing export control, consumer protection, unfair competition, anti-discrimination or false advertising). 
•	Involve any countries, entities, individuals or items prohibited by sanctions, embargoes, regulations or orders administered by the U.S. Department of Treasury’s Office of Foreign Assets Control (“OFAC”) or other government agencies. 
•	Contain items that have been identified by the U.S. Consumer Products Safety Commission (CPSC) as hazardous to consumers and therefore subject to a recall.
•	Be defamatory, trade libelous, unlawfully threatening, unlawfully harassing, impersonate or intimidate any person (including Fleecefinder staff or other user), or falsely state or otherwise misrepresent your affiliation with any person, through for example, the use of similar email address, nicknames, or creation of false account(s) or any other method or devise. 
•	Interfere with a seller’s business or shop. 
•	Take any action that may undermine online reviews or feedback. 
•	Be obscene or contain child pornography
•	Contain or transmit any code of a destructive nature that may damage, detrimentally interfere with, surreptitiously intercept or expropriate any system, data or personal information
•	Host images not part of a listing
•	Modify, adapt or hack Fleecefinder or modify another website so as to falsely imply that it is associated with Fleecefinder;
•	Appear to create liability for Fleecefinder or cause Fleecefinder to lose (in whole or in part) the services of Fleecefinder's ISPs or other suppliers
•	Link directly or indirectly, reference or contain descriptions of goods or services that are prohibited under this Agreement, the Privacy Policy, Fleecefinder Guidelines, or other policy documents as posted on Fleecefinder
Furthermore, you may not list any item on Fleecefinder (or consummate any transaction that was initiated using Fleecefinder's service) that, by paying to Fleecefinder the listing fee or the final value fee, could cause Fleecefinder to violate any applicable law, statute, ordinance or regulation, or that violates the Terms of Use.
 6. Content
License: Fleecefinder does not claim ownership rights in your Content. You grant Fleecefinder a license solely to enable Fleecefinder to use any information or Content you supply Fleecefinder with, so that Fleecefinder is not violating any rights you might have in that Content. You grant Fleecefinder a non-exclusive, worldwide, perpetual, irrevocable, royalty-free, sub-licensable (through multiple tiers) right to exercise the copyright, publicity, and database rights (but no other rights) you have in the Content, in any media now known or not currently known, with respect to your Content. You agree to allow Fleecefinder to store, translate, or re-format your Content on Fleecefinder and display your Content on Fleecefinder in any way Fleecefinder chooses. Fleecefinder will only use personal information in accordance with Fleecefinder's Privacy Policy.
As part of a transaction, you may obtain personal information, including email address and shipping information, from another Fleecefinder user. Without obtaining prior permission from the other user, this personal information shall only be used for that transaction or for Fleecefinder-related communications. Fleecefinder has not granted you a license to use the information for unsolicited commercial messages or unauthorized transactions. Without limiting the foregoing, without express consent from the user, you are not licensed to add any Fleecefinder user to your email or physical mail list. For more information, see Fleecefinder's Privacy Policy.
Re-Posting Content: By posting Content on Fleecefinder, it is possible for an outside website or a third party to re-post that Content. You agree to hold Fleecefinder harmless for any dispute concerning this use. If you choose to display your own Fleecefinder-hosted image on another website, the image must provide a link back to its listing page on Fleecefinder.
Idea Submissions: Fleecefinder considers any unsolicited suggestions, ideas, proposals or other material submitted to it by users via the Site or otherwise (other than the Content and the tangible items sold on the Site by users) (collectively, the "Material") to be non-confidential and non-proprietary, and Fleecefinder shall not be liable for the disclosure or use of such Material. If, at Fleecefinder's request, any member sends Material to improve the site (for example through customer support), Fleecefinder will also consider that Material to be non-confidential and non-proprietary and Fleecefinder will not be liable for use or disclosure of the Material. Any communication by you to Fleecefinder is subject to this Agreement. You hereby grant and agree to grant Fleecefinder, under all of your rights in the Material, a worldwide, non-exclusive, perpetual, irrevocable, royalty-free, fully-paid, sub-licensable and transferable right and license to incorporate, use, publish and exploit such Material for any purpose whatsoever, commercial or otherwise, including but not limited to incorporating it in the API, documentation, or any product or service, without compensation or accounting to you and without further recourse by you.
7. Information Control
Fleecefinder does not control the Content provided by users that is made available on Fleecefinder. You may find some Content to be offensive, harmful, inaccurate, or deceptive. There are also risks of dealing with underage persons or people acting under false pretense.
Additionally, there may also be risks dealing with international trade and foreign nationals. By using Fleecefinder, you agree to accept such risks and that Fleecefinder (and Fleecefinder's officers, directors, agents, subsidiaries, joint ventures and employees) is not responsible for any and all acts or omissions of users on Fleecefinder. Please use caution, common sense, and practice safe buying and selling when using Fleecefinder.
Other Resources: Fleecefinder is not responsible for the availability of outside websites or resources linked to or referenced on the Site. Fleecefinder does not endorse and is not responsible or liable for any content, advertising, products, or other materials on or available from such websites or resources. You agree that Fleecefinder shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such content, goods or services available on or through any such websites or resources.
8. Meetings
Users may arrange and attend online virtual meetings or in-person meetings ("Meetings") with one or more individuals. Users are solely responsible for interactions with others. Users must comply with Fleecefinder's policies and acknowledge and agree to comply with the laws of the city, county and country in which the Meeting occurs. Additional eligibility requirements for a particular group or Meeting may be set by the group's contact person. Fleecefinder is not involved with user generated groups, the groups' requirements, or the Meetings.
Fleecefinder does not supervise or control the Meetings, user-initiated online or offline gatherings, or the interactions among and between users and other persons or companies. Users are solely responsible for interactions with others. Users understand that Fleecefinder does not in any way screen its users. All users agree to exercise caution and good judgment in all interactions with others, particularly if meeting offline or in person.
Groups or User Fees: Some user-generated groups on Fleecefinder may require or request that users pay fees in order to be a member of the group, participate in a promotion, or participate in Meetings. FLEECEFINDER IS NOT INVOLVED IN THE TRANSACTIONS, THE PAYMENTS OR THEIR PROCESSING. THE PAYMENT DOES NOT GO TO FLEECEFINDER; THIS MONEY IS SEPARATE FROM ANY FEES OR CHARGES ASSESSED BY FLEECEFINDER, AND FLEECEFINDER HAS NO CONTROL OVER THE MONEY, THE USER-GENERATED GROUPS, PROMOTIONS, THE MEETINGS, OR THE LEADER OF THE GROUP IN CONNECTION WITH ITS USE. YOU ACKNOWLEDGE AND AGREE THAT FLEECEFINDER IS NEITHER INVOLVED NOR A PARTY IN ANY PAYMENT, TRANSACTION OR INTERACTION BETWEEN OR AMONG USER-GENERATED GROUPS, FLEECEFINDER USERS AND/OR THIRD PARTIES (together a "Third Party Transaction"), AND THAT YOU BEAR ALL RISK IN CONNECTION WITH YOUR THIRD PARTY TRANSACTIONS. Users should use common sense and be careful in deciding whether to contribute money.
9. Resolution of Disputes and Release
Disputes with Fleecefinder: In the event a dispute arises between you and Fleecefinder, please contact Fleecefinder. Any dispute arising from or relating to the subject matter of this Agreement shall be finally settled by arbitration in Benton County, Washington State, using the English language in accordance with the Arbitration Rules and Procedures of Judicial Arbitration and Mediation Services, Inc. ("JAMS") then in effect, by one commercial arbitrator with substantial experience in resolving intellectual property and commercial contract disputes, who shall be selected from the appropriate list of JAMS arbitrators in accordance with the Arbitration Rules and Procedures of JAMS. The prevailing party in any arbitration or other proceeding arising under this Agreement shall be entitled to receive reimbursement of its reasonable expenses (including reasonable attorneys' fees, expert witness fees and all other expenses) incurred in connection therewith. Judgment upon the award so rendered may be entered in a court having jurisdiction or application may be made to such court for judicial acceptance of any award and an order of enforcement, as the case may be. Notwithstanding the foregoing, each party shall have the right to institute an action in a court of proper jurisdiction for injunctive or other equitable relief pending a final decision by the arbitrator. For all purposes of this Agreement, the parties consent to exclusive jurisdiction and venue in the United States Federal Courts or state courts located in the Southern District of Washington State. Use of the Services is not authorized in any jurisdiction that does not give effect to all provisions of the Agreement, including without limitation, this section. You and Fleecefinder agree that any cause of action arising out of or related to the Services (including, but not limited to, any services provided or made available therein) or this Agreement must commence within one (1) year after the cause of action arose; otherwise, such cause of action is permanently barred.
Disputes with Users or Third Parties: In the event a dispute arises between you and another user or a third party, Fleecefinder encourages you to contact the user or third party to resolve the dispute amicably.  
If a buyer and seller are unable to resolve a dispute resulting from a transaction that occurs on Fleecefinder, they may choose to participate in Fleecefinder’s case system in order to resolve the dispute. Cases are escalated for review and resolution by Fleecefinder. Fleecefinder provides its dispute resolution process for the benefit of users. Fleecefinder does so in Fleecefinder's sole discretion, and Fleecefinder has no obligation to resolve disputes between users or between users and outside parties. To the extent that Fleecefinder attempts to resolve a dispute, Fleecefinder will do so in good faith based solely on Fleecefinder's policies. Fleecefinder will not make judgments regarding legal issues or claims.
You may also report user-to-user disputes to your local law enforcement, postmaster general, or a certified mediation or arbitration entity, as applicable.  
You release Fleecefinder (and Fleecefinder's officers, directors, agents, subsidiaries, joint ventures and employees) from any and all claims, demands and damages (actual and consequential) of every kind and nature, known and unknown, suspected and unsuspected, disclosed and undisclosed, arising out of or in any way connected with disputes with one or more users, or an outside party. 
10. Fleecefinder's Intellectual Property
FLEECEFINDER, and other Fleecefinder graphics, logos, designs, page headers, button icons, scripts, and service names are registered trademarks, trademarks or trade dress of Dwarven Knowledge LLC. in the U.S. and/or other countries. Fleecefinder's trademarks and trade dress may not be used, including as part of trademarks and/or as part of domain names or email addresses, in connection with any product or service in any manner that is likely to cause confusion.
11. Access and Interference
Fleecefinder may contain robot exclusion headers which contain internal rules for software usage. Much of the information on Fleecefinder is updated on a real-time basis and is proprietary or is licensed to Fleecefinder by Fleecefinder's users or third-parties. You agree that you will not use any robot, spider, scraper or other automated means to access Fleecefinder for any purpose whatsoever, except to the extent expressly permitted by and in compliance with Fleecefinder's API Terms of Use or otherwise without Fleecefinder's prior express written permission. Additionally, you agree that you will not:
•	Take any action that imposes, or may impose, in Fleecefinder's sole discretion, an unreasonable or disproportionately large load on Fleecefinder's infrastructure
•	Copy, reproduce, modify, create derivative works from, distribute or publicly display any user Content (except for your Content) or other allowed uses as set out in Fleecefinder Guidelines from the Site except to the extent expressly permitted by and in compliance with Fleecefinder's API Terms of Use or otherwise without the prior express written permission of Fleecefinder and the appropriate third party, as applicable
•	Interfere or attempt to interfere with the proper working of the Site or any activities conducted on the Site
•	Bypass Fleecefinder's robot exclusion headers or other measures Fleecefinder may use to prevent or restrict access to Fleecefinder
12. Breach
Without limiting any other remedies, Fleecefinder may, without notice, and without refunding any fees, delay or immediately remove Content, warn Fleecefinder's community of a user's actions, issue a warning to a user, temporarily suspend a user, temporarily or indefinitely suspend a user's account privileges, terminate a user's account, prohibit access to the Site, and take technical and legal steps to keep a user off the Site and refuse to provide services to a user if any of the following apply:
•	Fleecefinder suspects (by information, investigation, conviction, settlement, insurance or escrow investigation, or otherwise) a user has breached this Agreement, the Privacy Policy, Fleecefinder Guidelines, or other policy documents and community guidelines incorporated herein; Fleecefinder is unable to verify or authenticate any of your personal information or Content; or Fleecefinder believes that a user is acting inconsistently with the letter or spirit of Fleecefinder's policies, has engaged in improper or fraudulent activity in connection with Fleecefinder or the actions may cause legal liability or financial loss to Fleecefinder's users or to Fleecefinder.
•	Fleecefinder reserves the right to suspend and/or terminate a person's account or any accounts held by that person by virtue of association, including all usernames under which that person operates on Fleecefinder. 
13. Privacy
Except as provided in Fleecefinder's Privacy Policy Fleecefinder will not sell or disclose your personal information (as defined in the Privacy Policy) to third parties without your explicit consent. Fleecefinder stores and processes Content on computers located in the United States that are protected by physical as well as technological security.
14. No Warranty
FLEECEFINDER, FLEECEFINDER'S SUBSIDIARIES, OFFICERS, DIRECTORS, EMPLOYEES, AND FLEECEFINDER'S SUPPLIERS PROVIDE FLEECEFINDER'S WEB SITE AND SERVICES "AS IS" AND WITHOUT ANY WARRANTY OR CONDITION, EXPRESS, IMPLIED OR STATUTORY. FLEECEFINDER, FLEECEFINDER'S SUBSIDIARIES, OFFICERS, DIRECTORS, EMPLOYEES AND FLEECEFINDER'S SUPPLIERS SPECIFICALLY DISCLAIM ANY IMPLIED WARRANTIES OF TITLE, MERCHANTABILITY, PERFORMANCE, FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT. IN ADDITION, NO ADVICE OR INFORMATION (ORAL OR WRITTEN) OBTAINED BY YOU FROM FLEECEFINDER SHALL CREATE ANY WARRANTY. SOME STATES DO NOT ALLOW THE DISCLAIMER OF IMPLIED WARRANTIES, SO THE FOREGOING DISCLAIMER MAY NOT APPLY TO YOU. THIS WARRANTY GIVES YOU SPECIFIC LEGAL RIGHTS AND YOU MAY ALSO HAVE OTHER LEGAL RIGHTS THAT VARY FROM STATE TO STATE.
15. Liability Limit
IN NO EVENT SHALL FLEECEFINDER, AND (AS APPLICABLE) FLEECEFINDER'S SUBSIDIARIES, OFFICERS, DIRECTORS, EMPLOYEES OR FLEECEFINDER'S SUPPLIERS BE LIABLE FOR ANY DAMAGES WHATSOEVER, WHETHER DIRECT, INDIRECT, GENERAL, SPECIAL, COMPENSATORY, CONSEQUENTIAL, AND/OR INCIDENTAL, ARISING OUT OF OR RELATING TO THE CONDUCT OF YOU OR ANYONE ELSE IN CONNECTION WITH THE USE OF THE SITE, FLEECEFINDER'S SERVICES, OR THIS AGREEMENT, INCLUDING WITHOUT LIMITATION, LOST PROFITS, BODILY INJURY, EMOTIONAL DISTRESS, OR ANY SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES.
FLEECEFINDER'S LIABILITY, AND (AS APPLICABLE) THE LIABILITY OF FLEECEFINDER'S SUBSIDIARIES, OFFICERS, DIRECTORS, EMPLOYEES, AND SUPPLIERS, TO YOU OR ANY THIRD PARTIES IN ANY CIRCUMSTANCE IS LIMITED TO THE GREATER OF (A) THE AMOUNT OF FEES YOU PAY TO FLEECEFINDER IN THE 12 MONTHS PRIOR TO THE ACTION GIVING RISE TO LIABILITY, AND (B) $100. SOME STATES DO NOT ALLOW THE EXCLUSION OR LIMITATION OF INCIDENTAL OR CONSEQUENTIAL DAMAGES, SO THE ABOVE LIMITATION OR EXCLUSION MAY NOT APPLY TO YOU.
16. Indemnity
YOU AGREE TO INDEMNIFY AND HOLD FLEECEFINDER AND (AS APPLICABLE) FLEECEFINDER'S PARENT, SUBSIDIARIES, AFFILIATES, OFFICERS, DIRECTORS, AGENTS, AND EMPLOYEES, HARMLESS FROM ANY CLAIM OR DEMAND, INCLUDING REASONABLE ATTORNEYS' FEES, MADE BY ANY THIRD PARTY DUE TO OR ARISING OUT OF YOUR BREACH OF THIS AGREEMENT OR THE DOCUMENTS IT INCORPORATES BY REFERENCE, OR YOUR VIOLATION OF ANY LAW OR THE RIGHTS OF A THIRD PARTY.
17. No Guarantee
Fleecefinder does not guarantee continuous, uninterrupted access to the Site, and operation of the Site may be interfered with by numerous factors outside Fleecefinder's control.
18. Legal Compliance; Taxes
You shall comply with all applicable domestic and international laws, statutes, ordinances and regulations regarding your use of the Site and any Fleecefinder service and, if applicable, your listing, purchase, solicitation of offers to purchase, and sale of items. In addition, you shall be responsible for paying any and all taxes applicable to any purchases or sales of items you make using the Services (excluding any taxes on Fleecefinder's net income).
19. Severability
If any provision of this Agreement is held unenforceable, then such provision will be modified to reflect the parties' intention. All remaining provisions of this Agreement shall remain in full force and effect.
20. No Agency
You and Fleecefinder are independent contractors, and no agency, partnership, joint venture, employee-employer or franchiser-franchisee relationship is intended or created by this Agreement.
21. Fleecefinder Service
Fleecefinder reserves the right to modify or terminate the Fleecefinder service for any reason, without notice, at any time. Fleecefinder reserves the right to alter these Terms of Use or other Site policies at any time, so please review the policies frequently. If Fleecefinder makes a material change Fleecefinder will notify you here, by email, by means of a notice on our home page, or other places Fleecefinder deems appropriate. What constitutes a "material change" will be determined at Fleecefinder's sole discretion, in good faith, and using common sense and reasonable judgment.
22. Choice of Law
This Agreement shall in all respects be interpreted and construed with and by the laws of the State of Washington, excluding its conflicts of laws rules, and the United States of America.
23. Survival
Sections 3 (Fees and Services, Fees and Termination), 6 (Content, License), 7 (Information Control), 8 (Meetings, Groups or User Fees), 9 (Resolution of Dispute and Release), 10 (Fleecefinder's Intellectual Property), 11 (Access and Interference), 12 (Breach), 13 (Privacy), 14 (No Warranty), 15 (Liability Limit), 16 (Indemnity), 17 (No Guaranty), 19 (Severability), 20 (No Agency), 22 (Choice of Law) shall survive any termination or expiration of this Agreement.
24. Notices
Except as explicitly stated otherwise, any notices shall be given by postal mail to Fleecefinder; Attn: Legal Department; 25905 Spirit Lane, Kennewick, WA 99338 (in the case of Fleecefinder) or, in your case, to the email address you provide to Fleecefinder (either during the registration process or when your email address changes). Notice shall be deemed given 24 hours after email is sent, unless the sending party is notified that the email address is invalid. Alternatively, Fleecefinder may give you notice by certified mail, postage prepaid and return receipt requested, to the address provided to Fleecefinder. In such case, notice shall be deemed given three days after the date of mailing.
For issues with intellectual property, please provide the notice as specified in Fleecefinder's Copyright and Intellectual Property Policy.
25. Disclosures
The services hereunder are offered by Fleecefinder Inc., located at 25905 Spirit Lane, Kennewick, WA 99338. If you are a Washington State resident, you may have this same information emailed to you by sending a letter to the foregoing address with your email address and a request for this information.


</textarea> 
		</div><br>

</div>

<?php 
	//End of page wrap.
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/footer-bar.php');	
?> 
