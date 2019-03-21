
<block name="modal-head"></block>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">{pigcms{$modal_title}</h4>
</div>
<div class="modal-body" style="height: 45rem;overflow-y: scroll">
  <block name="modal_body"></block>
</div>
<div class="modal-footer">
    <block name="modal_footer"></block>
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
</div>
<!--<script src="./static/js/vue.min.js"></script>-->
<!--<script src="./static/js/vue-route.js"></script>-->
<!--<script src="./static/js/vue-resource.min.js"></script>-->
<block name="modal_script">

</block>
