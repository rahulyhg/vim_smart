/**
 * Created by admin on 2018/3/30.
 */
var UIButtons=function(){var t=function(){$(".demo-loading-btn").click(function(){var t=$(this);t.button("loading"),setTimeout(function(){t.button("reset")},3e3)}),Ladda.bind(".mt-ladda-btn",{timeout:2e3}),Ladda.bind(".mt-ladda-btn.mt-progress-demo ",{callback:function(t){var n=0,a=setInterval(function(){n=Math.min(n+.1*Math.random(),1),t.setProgress(n),1===n&&(t.stop(),clearInterval(a))},50)}})};return{init:function(){t()}}}();jQuery(document).ready(function(){UIButtons.init()});