@extends('ad.master')
@section('content')

<div class="pd-20">

	<table class="table table-border table-bordered table-bg">
		<thead>

			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">FID</th>
				<th width="150">设备名称</th>
				<th width="90">设备IP</th>
				<th width="150">所属用户</th>
 				<th width="130">所属产品</th>
				<th width="130">添加时间</th>
				<th width="130">更新时间</th>
				<th width="130">设备</th>

				<th width="100">状态</th>

			</tr>
		</thead>
		<tbody>
			<tr class="text-c">
				<td><input type="checkbox" value="1" name=""></td>
				<td>13000000000</td>
				<td>空气盒子01</td>
        <td>192.168.1.1</td>
				<td>18844069473</td>
				<td>空气盒子</td>
 				<td>2014-6-11 11:11:42</td>
				<td>2016-6-11 11:11:42</td>

				<td class="td-status"><span class="label label-success radius">空气盒子</span></td>
        <td class="td-status"><span class="label label-info radius">不在线</span></td>

 			</tr>

		</tbody>
	</table>
</div>
@section('my-js')
@endsection
