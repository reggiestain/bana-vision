<template>
	<!-- 
	=========================================================================
	PLEASE CREATE DEFAULT PROPS THAT WILL TAKE EFFECT WHEN POST IS MADE BUT WHEN EDITING THE POST THE VALUES 
	PASSED AS PROPS WILL BE THE INPUTS PLACEHOLDERS
	 -->
	<!--IF EVENT RADIO IS SELECTED-->
	<!--IF BURSARY RADIO IS SELECTED-->
	<div   class="col-12 row m-0 p-0">
		<!--=====================BURSARY TITLE==========================-->
		<div class="form-group col-12 row m-0 p-0 bursary-input-div" >
			<label for="inputPassword" class="col-3 col-form-label p-0">
				<strong>
					Title :
				</strong>
			</label>
			<div class="col-9 p-0 pl-1 $errors->has('bursaryTitle') ? 'has-error':''">
				<textarea class="form-control feeds-inputs" id="bursary-title" cols="10" rows="2" :placeholder="edit_post.title" v-on:change="post_helper.update_value($root,$event.target.value,'bursaryTitle')" :value="bursaryTitle"></textarea>
			</div>
		</div>
		<!--=====================BURSARY CLOSING DATE==========================-->
		<div class="form-group col-12 row m-0 p-0 bursary-input-div" >
			<label for="inputPassword" class="col-3 col-form-label p-0">
				<strong>
					Closing date :
				</strong>
			</label>
			<div class="col-9 p-0 pl-1 $errors->has('bursaryClosingDate') ? 'has-error':''" :placeholder="edit_post.closing_date">
				<input type="date"  class="form-control form-control-sm feeds-inputs" v-on:change="post_helper.update_value($root,$event.target.value,'bursaryClosingDate')" :value="bursaryClosingDate">
			</div>
		</div>
		<!--=====================BURSARY APPLICATION LINK==========================-->
		<div class="form-group col-12 row m-0 p-0 bursary-input-div" >
			<label for="inputPassword" class="col-3 col-form-label p-0">
				<strong>
					Application link :
				</strong>
			</label>
			<div class="col-9 p-0 pl-1 $errors->has('bursaryApplicationLink') ? 'has-error':''">
				<input type="url"  class="form-control form-control-sm feeds-inputs" formnovalidate="formnovalidate" :placeholder="edit_post.application_link" v-on:change="post_helper.update_value($root,$event.target.value,'bursaryApplicationLink')" :value="bursaryApplicationLink">
			</div>
		</div>
		<!--=====================BURSARY SECTOR==========================-->
		<div class="form-group col-12 row m-0 p-0 bursary-input-div" >
			<label for="inputPassword" class="col-3 col-form-label p-0">
				<strong>
					Sector :
				</strong>
			</label>
			<div class="col-9 p-0 pl-1 $errors->has('bursarySector') ? 'has-error':''">
				<textarea class="form-control feeds-inputs" id="event-venue" cols="10" rows="2"  :placeholder="edit_post.sector" v-on:change="post_helper.update_value($root,$event.target.value,'bursarySector')" :value="bursarySector"></textarea>
			</div>
		</div>
		<!--=====================BURSARY POSITIONS AVAILABLE==========================-->
		<div class="form-group col-12 row m-0 p-0 bursary-input-div" >
			<label for="bursary-positions-available" class="col-3 col-form-label p-0">
				<strong>
					Positions available :
				</strong>
			</label>
			<div class="col-9 p-0 pl-1 $errors->has('bursaryPositionsAvailable') ? 'has-error':''">
				<input type="number" min="0" class="form-control form-control-sm feeds-inputs"  :placeholder="edit_post.positions_available" id="bursary-positions-available" v-on:change="post_helper.update_value($root,$event.target.value,'bursaryPositionsAvailable')" :value="bursaryPositionsAvailable">
			</div>
		</div>
		<!--=====================BURSARY REQUIREMENT==========================-->
		<div class="form-group col-12 row m-0 p-0 bursary-input-div" >
			<label for="inputPassword" class="col-3 col-form-label p-0">
				<strong>
					Requirement :
				</strong>
			</label>
			<div class="col-9 p-0 pl-1 $errors->has('bursarySector') ? 'has-error':''">
				<input class="form-control feeds-inputs" id="bursary-requirement" cols="10" rows="2"  placeholder="what does the bursary require?" v-on:change="post_helper.update_value($root,$event.target.value,'bursaryRequirement')" :value="bursaryRequirement">
			</div>
		</div>
		<!--bursary requirements-->
		<div class=" bursary-input-div" id="requirements">
			<div v-for="requirement in bursaryRequirements">
				<div class="col-12">
					<span>
						<i class="fas fa-check-circle" style="color:#0000ff"></i>
					</span>
					<span class="ml-2">
						{{requirement}}
					</span>
				</div>
				<!--<input type="hidden" v-model="bursaryRequirements" value="+req+">-->
			</div>
		</div>
		<div class="col-12  bursary-input-div">
			<button type="button" class="btn btn-light btn-block btn-sm  bursary-input-div" id="add-requirement"  v-on:click="addrequirement">
				Add Requirement
			</button>
		</div>
	</div>
</template>
<script>
	import {Post} from '../../../Post.ts';
	export default {
		props:{
		edit_post:{
			default:{
				
					sector:'which sector is the bursary in?',
					title:"what is the name of the bursary?",
					positions_available:"How many positions are available?",
					application_link:"application link e.g example.com",
					closing_date:"2020-08-14",
				
			}
		}
	},
		data:function() {
        return {
        	post_helper:new Post(),
            errors_array:[],
            postType:'',
            video:'',
            image:null,
            post:'',
            bursaryRequirement:'',
            bursaryRequirements:[],
            bursaryPositionsAvailable:0,
            bursarySector:'',
            bursaryApplicationLink:'',
            bursaryClosingDate:'',
            bursaryTitle:'',
            imagePreview:false,
            imageData: [],
          }
        },
        methods:
        {
        	addrequirement()
        	{
            	//console.log("%c clicked",'font-size:60px;color:green');
            	this.bursaryRequirements.push(this.bursaryRequirement);
            	this.bursaryRequirement = '';
        	}
        }
	}
</script>