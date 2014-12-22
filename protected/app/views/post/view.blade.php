<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('config/dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('post?md='.$masterdetail["filtermd"]) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper">   
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('post?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="icon-table"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('post/add/'.$id.'?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="icon-pencil3"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  		   	  
		</div>
	<div class="table-responsive">
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>Post Id</td>
						<td>{{ $row->post_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post Typecustomer</td>
						<td>{{ $row->post_typecustomer }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post Subject</td>
						<td>{{ $row->post_subject }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post Provincefrom</td>
						<td>{{ $row->post_provincefrom }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post Districtfrom</td>
						<td>{{ $row->post_districtfrom }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post Addressfrom</td>
						<td>{{ $row->post_addressfrom }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post Provinceto</td>
						<td>{{ $row->post_provinceto }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post Districtto</td>
						<td>{{ $row->post_districtto }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post Addressto</td>
						<td>{{ $row->post_addressto }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post Datestar</td>
						<td>{{ $row->post_datestar }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post Price</td>
						<td>{{ $row->post_price }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post Typecar</td>
						<td>{{ $row->post_typecar }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post Note</td>
						<td>{{ $row->post_note }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post File1</td>
						<td>{{ $row->post_file1 }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post File2</td>
						<td>{{ $row->post_file2 }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Name</td>
						<td>{{ $row->name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Phone</td>
						<td>{{ $row->phone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Address</td>
						<td>{{ $row->address }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created</td>
						<td>{{ $row->created }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td>{{ $row->status }} </td>
						
					</tr>
				
		</tbody>	
	</table>    
	</div>
	</div>
</div>
	  