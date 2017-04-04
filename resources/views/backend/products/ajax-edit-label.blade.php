<div class="so-sp" style="
   /* border-top: solid 1px #EBEDED ; */
   padding-top: 9px;
   /* margin-left: -15px; */
   /* margin-right: -15px; */
   padding-left: 15px;
   padding-right: 15px;
   cursor: pointer;
   padding-bottom: 9px;
   background-color: rgb(246,246,246);
   ">
   <p style="color: #404040 ;margin-bottom: 0;" class="d-click-choose" data-label="0" data-id="{!! $frame->id !!}">
    Không nhãn 
    <span>@if($frame->label==0) <i class="material-icons pull-right">&#xe5ca;</i> @endif</span>
   </p>
</div>
<div class="email-tb" style="
   border-top: solid 1px #EBEDED ;
   padding-top: 9px;
   padding-bottom: 9px;
   padding-left: 15px;
   padding-right: 15px;
   cursor: pointer;
   /* background-color: rgb(246,246,246); */
   ">
   <p style="color: #BC0098 ;margin-bottom: 0;" class="d-click-choose" data-label="1" data-id="{!! $frame->id !!}">
   New 
    <span>@if($frame->label==1) <i class="material-icons pull-right" style="color: #BC0098">&#xe5ca;</i> @endif</span>
   </p>
</div>
<div class="nd-email" style="margin-bottom: 0px;border-top: solid 1px #EBEDED ;padding-top: 9px;padding-left: 15px;padding-right: 15px;cursor: pointer;padding-bottom: 9px;background-color: rgb(246,246,246);">
   <p style="color: #ff9900 ;margin-bottom: 0;" class="d-click-choose" data-label="2" data-id="{!! $frame->id !!}">
   Kool
    <span> @if($frame->label==2) <i class="material-icons pull-right" style="color: #ff9900">&#xe5ca;</i> @endif</span>
   </p>
</div>
<div class="nd-email" style="margin-bottom: 0px;border-top: solid 1px #EBEDED ;padding-top: 9px;padding-left: 15px;padding-right: 15px;cursor: pointer;">
   <p style="color: #00B0F0 ;" class="d-click-choose" data-label="3" data-id="{!! $frame->id !!}">
   Sale
    <span>@if($frame->label==3) <i class="material-icons pull-right" style="color: #00B0F0">&#xe5ca;</i> @endif</span> 
   </p>
</div>