<template>
	<!-- 
	=========================================================================
	PLEASE CREATE DEFAULT PROPS THAT WILL TAKE EFFECT WHEN POST IS MADE BUT WHEN EDITING THE POST THE VALUES 
	PASSED AS PROPS WILL BE THE INPUTS PLACEHOLDERS
	 -->
	<!--IF EVENT RADIO IS SELECTED-->
	<!--IF NEED RADIO IS SELECTED-->
	<div class="col-12 row m-0 p-0">
		<!--=====================NEED TITLE==========================-->
		<div class="form-group col-12 row m-0 p-0 need-input-div" >
			<label for="need-title" class="col-3 col-form-label p-0">
				<strong>
					Title :
				</strong>
			</label>
			<div class="col-9 p-0 pl-1 $errors->has('needTitle') ? 'has-error':''">
				<textarea class="form-control feeds-inputs" id="need-title" cols="10" rows="2" :placeholder="edit_post.title" v-on:change="post_helper.update_value($root,$event.target.value,'needTitle')" :value="needTitle"></textarea>
			</div>
		</div>
		<!--=====================NEED QUANTITY==========================-->
		<div class="form-group col-12 row m-0 p-0 need-input-div" >
			<label for="needQuantity" class="col-3 col-form-label p-0">
				<strong>
					Quantity :
				</strong>
			</label>
			<div class="col-9 p-0 pl-1 $errors->has('needQuantity') ? 'has-error':''">
				<input type="number" min="0" class="form-control form-control-sm feeds-inputs"  
				:placeholder="edit_post.quantity" id="needQuantity" v-on:change="post_helper.update_value($root,$event.target.value,'needQuantity')" :value="needQuantity">
			</div>
		</div>
		<!--=====================NEED CATEGORY==========================-->
		<div class="form-group col-12 row m-0 p-0 need-input-div" >
			<label for="need-category" class="col-3 col-form-label p-0">
				<strong>
					Category :
				</strong>
			</label>
			<div class="col-9 p-0 pl-1 {{$errors->has('needCategory') ? 'has-error':''">
				<textarea class="form-control feeds-inputs" id="need-category" cols="10" rows="2" 
				:placeholder="edit_post.category" v-on:change="post_helper.update_value($root,$event.target.value,'needCategory')" :value="needCategory"></textarea>
			</div>
		</div>
		<!--=====================NEED URGENCY==========================-->
		<div class="form-group col-12 row m-0 p-0 need-input-div" >
			<label for="need-urgency" class="col-3 col-form-label p-0">
				<strong>
					Urgency :
				</strong>
			</label>
			<div class="col-9 p-0 pl-1 $errors->has('needUrgency') ? 'has-error':''">
				<select class="custom-select form-control form-control-sm feeds-inputs" id="need-urgency" v-on:change="post_helper.update_value($root,$event.target.value,'needUrgency')" >
					<option selected>
						{{edit_post.urgency}}
					</option>
					<option value="1">
						Not urgent
					</option>
					<option value="2">
						Urgent
					</option>
					<option value="3">
						Very urgent
					</option>
				</select>
			</div>
		</div>
		<!--=====================NEED DUE DATE==========================-->
		<div class="form-group col-12 row m-0 p-0 bursary-input-div" >
			<label for="need-due-date" class="col-3 col-form-label p-0">
				<strong>
					Due date :
				</strong>
			</label>
			<div class="col-9 p-0 pl-1 $errors->has('needDueDate') ? 'has-error':''">
				<input type="date" id="need-due-date" class="form-control form-control-sm feeds-inputs" v-on:change="post_helper.update_value($root,$event.target.value,'needDueDate')" :value="needDueDate">
			</div>
		</div>
	</div>
</template>
<script>
	import {Post} from '../../../Post.ts';
	export default {
		props:{
		edit_post:{
			default:{
				"title":"what do you need?",
				"quantity":"How much of it do you need?",
				"category":"category which need belongs to?",
				"due_date":"2020-08-18",
				"urgency":"How urgent is your need?",
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
            needDueDate:'',
            needUrgency:'',
            needCategory:'',
            needQuantity:'',
            needTitle:'',
            imagePreview:false,
            imageData: [],
          }
        },
	}
</script>