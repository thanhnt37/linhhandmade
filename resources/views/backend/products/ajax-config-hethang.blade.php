<form action="" method="post" id="d-submit-config-hethang">
    <div class="modal-header">
     <table>
         <tr>
             <td style="width: 98%;"><h5 class="modal-title">Email thông báo sắp hết hàng</h5></td>
             <td><button>Lưu</button></td>
         </tr>
     </table>
 </div>
 <div class="modal-body p-lg">
     <div class="so-sp">
        <table style="width:100%">
            <tr style="width:100%">
                <td style="width: 50%">
                    <p style="text-align: left">Email nhận thông báo</p>
                    <input name="email" type="text" style="width:95%; float: left;" value="@if(isset($email)) {!! $email->email !!} @endif  ">
                </td>
                <td style="width: 50%">
                    <p style="text-align: left">Config số lượng</p>
                     <input name="config" type="text"  style="width:98%" value="@if(isset($email)) {!! $email->config_sku !!} @endif  ">
                </td>
            </tr>
         </table>
     </div>
     <div class="email-tb">
         <p>Tiêu đề email</p>
         <input name="description" type="text" class="form-control" disabled  value="{Domain} Sắp hết sản phẩm {Tên Sản Phẩm}">
     </div>
     <div class="nd-email" style="margin-bottom: 0px;">
         <p>Nội dung email</p>
         <textarea name="content" rows="4" cols="100" class="form-control" disabled >Sản phẩm dưới đây sắp hết. Bạn cần nhập kho
Tên sản phẩm: {Tên sản phẩm}
Mã sản phẩm: {Mã sản phẩm}
Số lượng hiện tại: {Số lượng}         </textarea>

     </div>
 </div>
</form>