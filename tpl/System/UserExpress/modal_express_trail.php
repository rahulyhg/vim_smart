
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">物流详情</h4>
</div>
<div class="modal-body" style="margin-top: 10px; padding-bottom: 30px;">
  <if condition="$error">
      {pigcms{$error}
      <else />
      <ul class="list-group">
          <volist name="info" id="row">
              <li class="list-group-item">
                  <p class="text-muted" style="margin:5px">{pigcms{$row.AcceptTime}</p>
                  <p style="margin:5px">{pigcms{$row.AcceptStation}</p>
              </li>
          </volist>
      </ul>
  </if>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>
<script src="/Car/Admin/Public/js/jquery.cookie.js"></script>

