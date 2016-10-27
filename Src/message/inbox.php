<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/nav-bar.php');
	
	//Everything is inside pagewrapper
?>

<style>



.profile {
  border-radius:100%;
  border: 2px solid #ffffff;
  width:55px;
  height:55px;
}
.stat {
  width:100%;
  background-color:#656D78;
  padding:10px;
  border-radius:5px;
  margin-top:10px;
  color:#CCD1D9;
}
button {
  width:100px;
  background:none;
  border:none;
  padding:20px 0px;
  color:#808080;
  cursor:pointer;
  border-radius:5px;
}
button:hover i {
  color:#4FC1E9;
}
button:active {
  background-color:#4FC1E9;
  color:#ffffff;
}
button:active i {
  color:#ffffff;
}
.content {
  width:100%;
  padding:0px;
  padding-left:200px;
}
.second-nav {
  height:100vh;
  width:300px;
  background-color:#F5F7FA;
  border-left:1px solid #e0e0e0;
  border-right:1px solid #e0e0e0;
 
  top:0px;
  left:0px;
  margin-left:-200px;
  margin-top:-20px;
}
.header {
  border-bottom:1px solid #e0e0e0;
  width:100%;
  padding:20px;
  font-size:20px;
}
.controls {
  background-color:#ffffff;
  width:100%;
  display:table;
  height:30px;
  border-bottom:1px solid #e0e0e0;
}
.control {
  display:table-cell;
  text-align:center;
  vertical-align:middle;
  cursor:pointer;
  position:relative;
  height:30px;
  width:20%;
}
.control:hover {
  color:#4FC1E9;
}
.control:hover > .comment {
  display:block;
}
.control:active {
  background-color:#4FC1E9;
  color:#ffffff;
}
.messages {
  display:table;
  width:100%;
  background-color:#F5F7FA;
}
.message {
  display:table-row;
  height:70px;
  font-size:14px;
  vertical-align:middle;
}
.cell {
  display:table-cell;
  vertical-align:middle;
  padding:0px 5px;
  padding-top:5px;
  width:100%;
  font-size:14px;
  border-bottom:1px solid #e0e0e0;
}
.checkbox {
  width:25px;
  float:left;
  padding-top:15px;
}
.profileImage {
  width:50px;
  float:left;
}
.profileImage img {
  border-radius:5px;
  width:45px;
}
.metadata {
  width:210px;
  padding-left:10px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  text-align:left;
  height:50px;
}
.metadata p {
  float:left;
  padding:0px;
  margin:0px;
  width:200px;
  font-size:13px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.from {
  font-weight:700;
  color:#808080;
}
.subject {
  color:#808080;
}
.comment {
  width:100px;
  height:40px;
  border-radius:5px;
  background-color:#ffffff;
  padding:10px;
  text-align:center;
  color:#808080;
  font-size:14px;
  position:absolute;
  bottom:-45px;
  left:50%;
  margin-left:-50px;
  border:1px solid #e0e0e0;
  display:none;
  z-index:10;
}
.comment:after {
  content:"";
	width: 0; 
	height: 0; 
  position:absolute;
  top:-5px;
  left:50%;
  margin-left:-5px;
	border-left: 5px solid transparent;
	border-right: 5px solid transparent;
	border-bottom: 5px solid #e0e0e0;
}
.comment .fa-times {
  position:absolute;
  top:3px;
  right:5px;
  cursor:pointer;
}
/*Adding custom checkbox icons*/
label {
	position: relative;
	padding-left: 30px;
	font-size: 14px;
	cursor: pointer;
}
label:before, label:after {
	font-family: FontAwesome;
	font-size: 21px;
	/*absolutely positioned*/
	position: absolute; top: 0; left: 0;
  
}
label:before {
	content: '\f096'; /*unchecked*/
}
label:after {
	content: '\f046'; /*checked*/
	/*checked icon will be hidden by default by using 0 max-width and overflow hidden*/
	max-width: 0;
	overflow: hidden;
	opacity: 0.5;
	/*CSS3 transitions for animated effect*/
	transition: all 0.35s;
  color:#4FC1E9;
}

/*hiding the original checkboxes*/
input[type="checkbox"] {
	display: none;
}
/*when the user checks the checkbox the checked icon will animate in*/
input[type="checkbox"]:checked + label:after {
	max-width: 25px; /*an arbitratry number more than the icon's width*/
	opacity: 1; /*for fade in effect*/
}

.viewer {
  margin-left:100px;
}
.viewer .header {
  background-color:#2ECC71;
  position:relative;
  color:#AAB2BD;
}
.scroll {
margin-top: -910px;
  height:100vh;
  overflow-y:scroll;
}
#email {
  padding:0px;
  padding-left:100px;
  padding-top:20px;
}
#email p {
  color:#656d78;
  font-size:14px;
  margin:0px;
  padding:0px;
}
#email .subject {
  font-weight:700;
}
.viewer .header img {
  width:60px;
  position:absolute;
  top:20px;
  left:20px;
}

.body h1 {
  font-weight:300;
}
.body img {
  width:100%;
  border-radius:10px;
  max-width:600px;
  cursor:pointer;
  transition:all 1s;
}
.body img:hover {
  box-shadow:0px 0px 10px rgba(0,0,0, 1);
}
.imagedisplay {
  position:fixed;
  top:0px;
  left:0px;
  width:100%;
  height:100%;
  background:#434A54;
  display:none;
  padding:20px;
  text-align:center;
  vertical-align:middle;
}
.viewimage {
  width:600px;
}
.viewimage img {
  width:100%;
}
</style>



<div class="container_12 backgroundwhite">
<div class="content">
  <div class="second-nav">
    <div class="header">
      Inbox
    </div>
    <div class="controls">
      <div class="control">
        <i class="fa fa-trash-o fa-1x"></i>
        <div class="comment bottom">Delete</div>
      </div>
      <div class="control">
        <i class="fa fa-mail-reply fa-1x"></i>
        <div class="comment bottom">Reply</div>
      </div>
      <div class="control">
        <i class="fa fa-mail-forward fa-1x"></i>
        <div class="comment bottom">Forward</div>
      </div>
      <div class="control">
        <i class="fa fa-search fa-1x"></i>
        <div class="comment bottom">Search</div>
      </div>
      <div class="control">
        <i class="fa fa-folder-o fa-1x"></i>
        <div class="comment bottom">Move</div>
      </div>
    </div>
    <div class="messages">
      <div class="message">
        <div class="cell">
          <div class="checkbox">
            <input type="checkbox" name="1" id="1" />
		        <label for="1"></label>
          </div>
          <div class="profileImage">
            <img src="https://s3.amazonaws.com/uifaces/faces/twitter/peterlandt/128.jpg"/>
          </div>
          <div class="metadata">
            <p class="from">Jake Rodway</p><br/>
            <p class="subject">Whats up tom? I've been looking at your recent dribbble works and I think they look great!<p>
          </div>
        </div>
      </div>
    </div>
    <div class="messages">
      <div class="message">
        <div class="cell">
          <div class="checkbox">
            <input type="checkbox" name="2" id="2" />
		        <label for="2"></label>
          </div>
          <div class="profileImage">
            <img src="https://s3.amazonaws.com/uifaces/faces/twitter/osvaldas/128.jpg"/>
          </div>
          <div class="metadata">
            <p class="from">Jack Woolley</p><br/>
            <p class="subject">Hey, I was just emailing you to see if you have made the drafts yet? I need them as  soon as possible<p>
          </div>
        </div>
      </div>
    </div>
    <div class="messages">
      <div class="message">
        <div class="cell">
          <div class="checkbox">
            <input type="checkbox" name="3" id="3" />
		        <label for="3"></label>
          </div>
          <div class="profileImage">
            <img src="https://s3.amazonaws.com/uifaces/faces/twitter/angelceballos/128.jpg"/>
          </div>
          <div class="metadata">
            <p class="from">Ben Jones</p><br/>
            <p class="subject">Hey, I was just emailing you to see if you have made the drafts yet? I need them as  soon as possible<p>
          </div>
        </div>
      </div>
    </div>
    <div class="messages">
      <div class="message">
        <div class="cell">
          <div class="checkbox">
            <input type="checkbox" name="4" id="4" />
		        <label for="4"></label>
          </div>
          <div class="profileImage">
            <img src="https://s3.amazonaws.com/uifaces/faces/twitter/michaelmartinho/128.jpg"/>
          </div>
          <div class="metadata">
            <p class="from">Oliver Holder</p><br/>
            <p class="subject">Hey, I was just emailing you to see if you have made the drafts yet? I need them as  soon as possible<p>
          </div>
        </div>
      </div>
    </div>
    <div class="messages">
      <div class="message">
        <div class="cell">
          <div class="checkbox">
            <input type="checkbox" name="5" id="5" />
		        <label for="5"></label>
          </div>
          <div class="profileImage">
            <img src="https://s3.amazonaws.com/uifaces/faces/twitter/aaronalfred/128.jpg"/>
          </div>
          <div class="metadata">
            <p class="from">Alexis Zaninetti</p><br/>
            <p class="subject">Hey, I was just emailing you to see if you have made the drafts yet? I need them as  soon as possible<p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="viewer">
  
    <div class="scroll">
      <div class="header" id="email">
        <img src="https://s3.amazonaws.com/uifaces/faces/twitter/osvaldas/128.jpg" style="border-radius:5px;" />
        <p class="subject">Subject: Recent Project</p>
        <p class="message">To: Me, Jack Woolley, Alexis Zaninetti</p>
      </div>
      <div class="body">
        <h1>RE: Recent Project</h1>
        <p>
          Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.<br/><br/>

          Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions.<br/><br/>

          Completely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service.<br/><br/>

          Objectively innovate empowered manufactured products whereas parallel platforms. Holisticly predominate extensible testing procedures for reliable supply chains. Dramatically engage top-line web services vis-a-vis cutting-edge deliverables.<br/><br/>

          Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing. Holistically pontificate installed base portals after maintainable products.<br/><br/>

          Phosfluorescently engage worldwide methodologies with web-enabled technology. Interactively coordinate proactive e-commerce via process-centric "outside the box" thinking. Completely pursue scalable customer service through sustainable potentialities.<br/><br/>

          Collaboratively administrate turnkey channels whereas virtual e-tailers. Objectively seize scalable metrics whereas proactive e-services. Seamlessly empower fully researched growth strategies and interoperable internal or "organic" sources.<br/><br/>
        </p>
        <img src="http://i.imgur.com/ewYZAQc.jpg" class="zoom" id="image-1"/>
        <p>
          Credibly innovate granular internal or "organic" sources whereas high standards in web-readiness. Energistically scale future-proof core competencies vis-a-vis impactful experiences. Dramatically synthesize integrated schemas with optimal networks.<br/><br/>

          Interactively procrastinate high-payoff content without backward-compatible data. Quickly cultivate optimal processes and tactical architectures. Completely iterate covalent strategic theme areas via accurate e-markets.<br/><br/>

          Globally incubate standards compliant channels before scalable benefits. Quickly disseminate superior deliverables whereas web-enabled applications. Quickly drive clicks-and-mortar catalysts for change before vertical architectures.<br/><br/>
        </p>
      </div>
    </div>
  </div>
</div>

<div class="imagedisplay">
  <div class="viewimage">
    
  </div>
</div>
	
	<div class="splitter" style="margin-bottom:20px"></div>
	
</div>


<?php 
	//End of page wrap.
	require_once($_SERVER['DOCUMENT_ROOT'] . '/global/footer-bar.php');	
?> 
