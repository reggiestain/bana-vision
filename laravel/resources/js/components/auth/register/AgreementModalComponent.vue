<template>
	<!--Modal for   messages-->
<div class='modal fade' id='agreement-modal' tabindex='-1' role='dialog'
data-backdrop="static" data-keyboard="false" aria-labelledby="agreement_modalLabel" aria-hidden="true" style="z-index:200000">
  <div class='modal-dialog' role='document'>
    
    <div class='modal-content' style="border-radius: 0.9rem;">
      <div class='modal-body'>
       

        <div><h5>Terms of use</h5></div>
		<form>
		<div class="form-check" style="padding-bottom: 0.25rem;">
			<input class="form-check-input" type="checkbox" value="" id="agreement-check">
			<label class="form-check-label" for="defaultCheck1">
				I have read and agree to the <a id="terms"  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Terms and Conditions</a>
			</label>
		</div>
		<div class="collapse" id="collapseExample" style="max-height: 20rem;overflow: scroll;">
			<div class="card card-body" style="background-color: #f0f0f0 ">
				<ol>
				<li><strong>Introduction.</strong>
<br>
These Website Standard Terms And Conditions (these “Terms” or these “Website Standard Terms And Conditions”) contained herein on this webpage, shall govern your use of this website, including all pages within this website (collectively referred to herein below as this “Website”). These Terms apply in full force and effect to your use of this Website and by using this Website, you expressly accept all terms and conditions contained herein in full. You must not use this Website, if you have any objection to any of these Website Standard Terms And Conditions.

This Website is not for use by any minors (defined as those who are not at least 18 years of age), and you must not use this Website if you a minor.

Intellectual Property Rights.

Other than content you own, which you may have opted to include on this Website, under these Terms, <strong>Bana</strong> and/or its licensors own all rights to the intellectual property and material contained in this Website, and all such rights are reserved.

You are granted a limited license only, subject to the restrictions provided in these Terms, for purposes of viewing the material contained on this Website,

PandaTip: If the website is only for viewing, then you might be able to stop where we left off above. That said, you will likely need to provide more in the way of descriptive language around what users may use the website to do/for.
</li>
<br>
<li>
<strong>Restrictions.</strong>
<br>
You are expressly and emphatically restricted from all of the following:

publishing any Website material in any media;

selling, sublicensing and/or otherwise commercializing any Website material;

publicly performing and/or showing any Website material;

using this Website in any way that is, or may be, damaging to this Website;

using this Website in any way that impacts user access to this Website;

using this Website contrary to applicable laws and regulations, or in a way that causes, or may cause, harm to the Website, or to any person or business entity;

engaging in any data mining, data harvesting, data extracting or any other similar activity in relation to this Website, or while using this Website;

using this Website to engage in any advertising or marketing;

Certain areas of this Website are restricted from access by you and <strong>Bana</strong> may further restrict access by you to any areas of this Website, at any time, in its sole and absolute discretion.  Any user ID and password you may have for this Website are confidential and you must maintain confidentiality of such information.
</li>
<br>
<li>
<strong>Your Content.</strong>
<br>
In these Website Standard Terms And Conditions, “Your Content” shall mean any audio, video, text, images or other material you choose to display on this Website. With respect to Your Content, by displaying it, you grant <strong>Bana</strong> a non-exclusive, worldwide, irrevocable, royalty-free, sublicensable license to use, reproduce, adapt, publish, translate and distribute it in any and all media.

Your Content must be your own and must not be infringing on any third party’s rights. <strong>Bana</strong> reserves the right to remove any of Your Content from this Website at any time, and for any reason, without notice.
</li>
<br>
<li>
<strong>No warranties.</strong>
<br>
This Website is provided “as is,” with all faults, and <strong>Bana</strong> makes no express or implied representations or warranties, of any kind related to this Website or the materials contained on this Website. Additionally, nothing contained on this Website shall be construed as providing consult or advice to you.
</li>
<br>
<li>
<strong>Limitation of liability.</strong>
<br>
In no event shall <strong>Bana</strong>, nor any of its officers, directors and employees, be liable to you for anything arising out of or in any way connected with your use of this Website, whether such liability is under contract, tort or otherwise, and <strong>Bana</strong>, including its officers, directors and employees shall not be liable for any indirect, consequential or special liability arising out of or in any way related to your use of this Website.
</li>
<br>
<li>
<strong>Indemnification.</strong>
<br>
You hereby indemnify to the fullest extent <strong>Bana</strong> from and against any and all liabilities, costs, demands, causes of action, damages and expenses (including reasonable attorney’s fees) arising out of or in any way related to your breach of any of the provisions of these Terms.
</li>
<br>
<li>
<strong>Severability.</strong>
<br>
If any provision of these Terms is found to be unenforceable or invalid under any applicable law, such unenforceability or invalidity shall not render these Terms unenforceable or invalid as a whole, and such provisions shall be deleted without affecting the remaining provisions herein.
</li>
<br>
<li>
<strong>Variation of Terms.</strong>
<br>
<strong>Bana</strong> is permitted to revise these Terms at any time as it sees fit, and by using this Website you are expected to review such Terms on a regular basis to ensure you understand all terms and conditions governing use of this Website.
</li>
<br>
<li>
<strong>Assignment.</strong>

<strong>Bana</strong> shall be permitted to assign, transfer, and subcontract its rights and/or obligations under these Terms without any notification or consent required. However, .you shall not be permitted to assign, transfer, or subcontract any of your rights and/or obligations under these Terms.

Entire Agreement.

These Terms, including any legal notices and disclaimers contained on this Website, constitute the entire agreement between <strong>Bana</strong> and you in relation to your use of this Website, and supersede all prior agreements and understandings with respect to the same.

Governing Law & Jurisdiction.

These Terms will be governed by and construed in accordance with the laws of the State of [STATE], and you submit to the non-exclusive jurisdiction of the state and federal courts located in [STATE] for the resolution of any disputes.
</li>
<br>
</ol>
			</div>
		</div>
        </form>
        <div class="modal-footer" style="padding-top: 0.25rem;padding-right: 0;padding-left: 0;padding-bottom: 0;">
        <span class="d-flex mr-auto">
        <button type="button" id="register-modal-submit" class="btn btn-primary btn-sm " @click="agree">Sign up</button>

        <button style="margin-left: 0.25rem;" type="button" class="btn btn-secondary btn-sm " data-dismiss="modal">Decline</button>
        </span>
      </div>
    </div>
    
      
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</template>
<script>
/*	  $(document).on('click','#register-modal-submit',function(){
  if($('#agreement-check').is(':checked'))
  {
    $('#submit-register').trigger('click'); 
  }
  
});*/
	export default{
		methods:
		{
			agree:function(){
				console.log("I agree ");
				if($('#agreement-check').is(':checked'))
    				$('#submit-register').trigger('click'); 
			}
		}
	}
</script>