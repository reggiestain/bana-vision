<template>
	<div>
		<featured-sidebar :options="{url:'featured-students',name:'Featured Students',caption:'achievements',type:'featured_student'}"></featured-sidebar>
		<featured-sidebar :options="{url:'student-projects',name:'Student Projects',caption:'name',type:'student_project'}"></featured-sidebar>
		
	</div>
</template>
<script>
	import  FeaturedSidebarComponent from './FeaturedSidebarComponent';
	export default{
		components:{
			'featured-sidebar':FeaturedSidebarComponent,
		}
	}
</script>