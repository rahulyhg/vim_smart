<!doctype html>

<html>

	<head>

		<meta charset="utf-8"/> 

		<title>{pigcms{$config.site_name}</title>

		<meta name="author" content="{pigcms{$config.site_name}"/>

		<meta name="generator" content="{pigcms{$config.site_name}"/>

		<meta name="copyright" content="baocms.com"/>

		<style>

		    body {

		        background: #f8f8f8;

		        font-family: Helvetica,STHeiti,"Microsoft YaHei",Verdana,Arial,Tahoma,sans-serif;

		    }

		

		    .main-panel {

		        border: 1px solid #e5e5e5;

		        background: #fff;

		        width: 600px;

		        height: 300px;

		        margin: 100px auto 0;

		        text-align: center;

		    }

		

		    .main-panel-body {

		        margin-top: 60px;

		    }

		

		    .success-title {

		        color: #4b0;

		        font-size: 22px;

		        line-height: 28px;

		    }

		

		    .default-title {

		        font-size: 22px;

		        line-height: 28px;

		    }

		

		    .info {

		        font-size: 14px;

		    }

		

		    .info-row {

		        margin-top: 20px;

		    }

		

		    .icon {

		        width: 48px;

		        height: 48px;

		        margin: 15px auto;

		    }

		

		    .icon img {

		        width: 100%;

		    }

		

		    .footer {

		        margin-top: 200px;

		    }

		    #BDBridgeWrap {

		        display: none !important;

		    }

		    h1, h2, h3, h4, h5, h6 {

				margin: 10px 0;

				font-family: inherit;

				font-weight: bold;

				line-height: 20px;

				color: inherit;

				text-rendering: optimizelegibility;

			}

			p {

				margin: 0 0 10px;

			}

			img {

				width: auto\9;

				height: auto;

				max-width: 100%;

				vertical-align: middle;

				border: 0;

				-ms-interpolation-mode: bicubic;

			}

			.footer {

				text-align: center;

				color: #999;

			}

			.footer .copyright a {

				color: #999;

			}

			a {

				color: #07d;

				text-decoration: none;

			}

			.btn {

display: inline-block;

padding: 4px 12px;

margin-bottom: 0;

font-size: 14px;

line-height: 20px;

color: #333333;

text-align: center;

vertical-align: middle;

cursor: pointer;

background-color: #f8f8f8;

border: 1px solid #ddd;

-webkit-border-radius: 2px;

-moz-border-radius: 2px;

border-radius: 2px;

}

.default-title {

font-size: 22px;

line-height: 28px;

}

		</style>

	</head>

	<body class="theme theme--blue">

		<div class="js-notifications notifications"></div>

		<div class="container">

			<div class="content" role="main">

				<div class="app">

					<div class="app-init-container">

						<div class="main-panel">

							<div class="main-panel-body">

								<div class="icon">

									<img src="/tpl/Static/default/images/fail.png">

								</div>

								<h4 class="default-title">抱歉，绑定失败了</h4>

				                <p class="info" style="font-size:16px;">出错信息：{pigcms{$errmsg}</p>

				                <div class="info-row">

				                    <a href="javascript:window.close();" class="btn btn-default">关闭本页</a>

				                </div>

							</div>  

						</div>

					  	<div class="footer">

					        <p class="copyright">© <a href="{pigcms{$config.site_url}">{pigcms{$config.site_url}</a></p>

					    </div>           

					</div>

					<div class="notify-bar js-notify animated hinge hide"></div>

				</div>

			</div>

		</div>

	</body>

</html>