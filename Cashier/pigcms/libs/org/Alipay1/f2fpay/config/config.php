<?php
$config = array (
	//支付宝公钥
	'alipay_public_key' => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDIgHnOn7LLILlKETd6BFRJ0GqgS2Y3mn1wMQmyh9zEyWlz5p1zrahRahbXAfCfSqshSNfqOmAQzSHRVjCqjsAw1jyqrXaPdKBmr90DIpIxmIyKXv4GGAkPyJ/6FTFY99uhpiq0qadD/uSzQsefWo0aTvP/65zi3eof7TcZ32oWpwIDAQAB",

	//商户私钥
	'merchant_private_key' => "MIICXAIBAAKBgQD2B7sThWUXihlVg9z+KRDgeXqoGh0NtH/3eIezf+16lKFwt/3af29hsRAu25CdVyMUQlCWOl23OzwKgZgg0TWcaVaLSy5ZIqNiGHBZdnXRjBJB+KNqjE51ggnQMLMyPq6bs9aRxIFCLpQdyE+8E36liR8Zg8/BAkcKqytfnAfJkQIDAQABAoGAImBAJmEcF+bm1UkAZs7MGeE/Xx+O8axHuQcxRsZYIymDSSGcKZxmrqqzzShGk4VqVFlTsznigEiZggpLfEJfD/6QlaMrPp7ddiSRXLIGJP29VS3vNpUpY71+xuLAUtzudi3o6CnRYoobOq/jLRWkSYmLIqTUCzKVe1QnlsZ6mYUCQQD+MtD8V3WqG07IBvieHK1Yxjfm/nJCBvuhGUbGlpx6o+q8iRIeJuIm5J4zgRGi2sKsbX4G2ipnd2NCJGVst0uDAkEA98YYTjMfr8WUgF8ODer2olULLgJxXEGUeADhfdC4nuf3RFI4pbj/rWRFw3FnIA70no4Y2OPOnM4XP1iVwyOmWwJASyFl109aPZ64mDJHRSQgr/5WA3Xs+0rpEGJSItvc//p2pKa2ria77NbhU0OwnLufkisCdrAAnHgS5DexqoI6VQJBAKnBggOJyUrfHpg5B+MHOUUM6STzrYEcuUDisZtGtkbA/MtFXeRE9H9ydM2r05DGTliXWHS412TdWlYfNjRFJ4MCQDpjDty8uw/IB2H3f6N11rNV2GoBaVYWIk7kE6gXAZ1RUccRThi+s9VxVJ672V7troqnfr1JmZCc34frc5Pv8hU=",

	//编码格式
	'charset' => "UTF-8",

	//支付宝网关
	'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

	//应用ID
	'app_id' => "2016101500692854",

	//异步通知地址,只有扫码支付预下单可用
	'notify_url' => "http://www.baidu.com",

	//最大查询重试次数
	'MaxQueryRetry' => "10",

	//查询间隔
	'QueryDuration' => "3"
);