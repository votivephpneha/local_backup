<style type="text/css">
#progressbar {
	margin-bottom: 30px;
	overflow: hidden;
	color: lightgrey
}

#progressbar .active {
	color: #2F8D46
}

#progressbar li {
	list-style-type: none;
	font-size: 15px;
	width: 20%;
	float: left;
	position: relative;
	font-weight: 400
}

#progressbar #step1:before {
	content: "1"
}

#progressbar #step2:before {
	content: "2"
}


#progressbar #step4:before {
	content: "3"
}

#progressbar #step5:before {
	content: "4"
}

#progressbar li:before {
	width: 50px;
	height: 50px;
	line-height: 45px;
	display: block;
	font-size: 20px;
	color: #ffffff;
	background: lightgray;
	border-radius: 50%;
	margin: 0 auto 10px auto;
	padding: 2px
}

#progressbar li:after {
	content: '';
	width: 100%;
	height: 2px;
	background: lightgray;
	position: absolute;
	left: 0;
	top: 25px;
	z-index: 0;
}

#progressbar li.active:before,
#progressbar li.active:after {
	background: #2F8D46
}

.progress {
	height: 20px
}

.progress-bar {
	background-color: #2F8D46
}

</style>
<ul id="progressbar">
	@if($track_order_data->order_status == '0')
	<li class="active" id="step1">
		<strong>Pending</strong>
	</li>
	<li id="step2"><strong>Accept</strong></li>
	
	<li id="step4"><strong>On the way</strong></li>
	<li id="step5"><strong>Delivered</strong></li>
	@endif
	@if($track_order_data->order_status == '1')
	<li class="active" id="step1">
		<strong>Pending</strong>
	</li>
	<li class="active" id="step2"><strong>Accepted</strong></li>
	
	<li id="step4"><strong>On the way</strong></li>
	<li id="step5"><strong>Delivered</strong></li>
	@endif
	@if($track_order_data->order_status == '2')
	<li class="active" id="step1">
		<strong>Pending</strong>
	</li>
	<li class="active" id="step2"><strong>Accepted</strong></li>
	
	<li id="step4"><strong>On the way</strong></li>
	<li id="step5"><strong>Delivered</strong></li>
	@endif
	@if($track_order_data->order_status == '3')
	<li class="active" id="step1">
		<strong>Pending</strong>
	</li>
	<li class="active" id="step2"><strong>Accepted</strong></li>
	
	<li class="active" id="step4"><strong>On the way</strong></li>
	<li id="step5"><strong>Delivered</strong></li>
	@endif
	@if($track_order_data->order_status == '4')
	<li class="active" id="step1">
		<strong>Pending</strong>
	</li>
	<li class="active" id="step2"><strong>Accepted</strong></li>
	
	<li class="active" id="step4"><strong>On the way</strong></li>
	<li class="active" id="step5"><strong>Delivered</strong></li>
	@endif
</ul>