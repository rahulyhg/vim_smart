
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{pigcms{$tpl_options['title']}</h4>
</div>
<div class="modal-body">

   {pigcms{$html}
    <if condition="$tpl_data['url']">
        <a target="_blank" href="{pigcms{$tpl_data['url']}">详情</a>
    </if>
</div>

<div class="modal-footer">

</div>
<script>

</script>