<template>
	<div class="col-12 row m-0 p-0">
		<!--=====================EVENT NAME==========================-->
		<div class="form-group col-12 row m-0 p-0 event-input-div" >
			<label for="eventName" class="col-3 col-form-label p-0">
				<strong>
					Name :
				</strong>
			</label>
			<div class="col-9 p-0 $errors->has('eventName') ? 'has-error':''">
				<textarea class="form-control feeds-inputs" id="eventName" cols="10" rows="2" :placeholder="edit_post.name" v-on:change="post_helper.update_value($root,$event.target.value,'eventName')" :value="eventName"></textarea>
			</div>
		</div>
		<!--=====================EVENT VENUE==========================-->
		<div class="form-group col-12 row m-0 p-0 event-input-div" >
			<label for="inputPassword" class="col-3 col-form-label p-0">
				<strong>
					Venue :
				</strong>
			</label>
			<div class="col-9 p-0 pl-1 $errors->has('eventVenue') ? 'has-error':''">
				<textarea class="form-control feeds-inputs" id="event-venue" cols="10" rows="2" :placeholder="edit_post.venue" v-on:change="post_helper.update_value($root,$event.target.value,'eventVenue')"  :value="eventVenue"></textarea>
			</div>
		</div>
		<!--=====================EVENT DATE==========================-->
		<div class="form-group col-12 row m-0 p-0 align-items-start    event-input-div" >
			<label for="inputPassword" class="col-3 col-form-label p-0">
				<strong>
					Date :
				</strong>
			</label>
			<div class="col-9 p-0 pl-1 $errors->has('eventDate') ? 'has-error':''">
				<input type="date" class="form-control form-control-sm feeds-inputs p-0" v-on:change="post_helper.update_value($root,$event.target.value,'eventDate')" :placeholder="edit_post.date"  :value="eventDate">
			</div>
		</div>
		<!--=====================EVENT TIMESLOT==========================-->
		<div class="form-group col-12 row m-0 p-0   event-input-div" >
			<label for="inputPassword" class="col-3 col-form-label p-0">
				<strong>
					Timeslot :
				</strong>
			</label>
			<div class="col-4 p-0 pl-1 $errors->has('eventTimeslot') ? 'has-error':''">
				<input type="time" class="form-control form-control-sm feeds-inputs p-0" id="event-timeslot-from" :placeholder="edit_post.from" v-on:change="post_helper.update_value($root,$event.target.value,'eventTimeslotFrom')"  value="eventTimeslotFrom">
			</div>
			<div class="col-1 p-0 text-center"><strong>-</strong></div>
			<div class="col-4 p-0 pl-1 $errors->has('eventTimeslot') ? 'has-error':''">
				<input type="time" class="form-control form-control-sm feeds-inputs p-0" id="event-timeslot-to" :placeholder="edit_post.to" v-on:change="post_helper.update_value($root,$event.target.value,'eventTimeslotTo')"  value="eventTimeslotTo">
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
					"name":"what is the event name?",
					"venue":"Where will the event take place?",
					"date":"2017-01-1",
					"timeslot":"7-8",
					"from":'From?',
					"to":'to?'
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
            eventTimeslotFrom:'',
            eventTimeslotTo:'',
            eventVenue:'',
            eventDate:'',
            eventName:'',
            imagePreview:false,
            imageData: [],
          }
        },
        methods:
        {

        },
        computed:
        {
        }
	}
</script>