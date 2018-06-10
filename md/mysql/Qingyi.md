# qingyi Database

## qy_admin_sms_invite [static]

| id | qid  | ivite_uid  | sms_time  |
| -- | -- | -- | -- |
| | 问题id | 邀请回答用户uid | 短信发送时间 |

## qy_certificate [user]

| id | uid | identity_id | identity_name | name_cert_img | name_cert_phone | name_cert_status | name_cert_fail_reason | time |
| -- |
| | | 身份证 | 身份证姓名 | 手持身份证照片 | 认证手机号 | 0未申请 1审核中 2成功 3失败 | 认证失败原因 | 时间 |

## qy_comment [comment]

| cid |  as_post_id | uid | content | at_users | time | update_time | status | praise_cnt  |
| -- |
| | 评论对应的转发文pid | 发评论的用户uid | 评论内容 | 评论里@用户 | | | | 该评论点赞总数 |

| post_id |  post_user_id |  post_as_comment_id |
| -- |
|  评论文章pid | 被评论文章的uid | 文章也是转发文，转发文对应的评论cid |

| parent_comment_id | parent_user_id | parent_comment_as_post_id  |
| -- |
| 父评论 cid | 父评论的 uid  | 父评论对应转发文的pid |

- 评论一篇文章 并 同时转发的话，会产生一篇 与 评论内容一致的转发文.

## qy_company [company]

| company_id | uid | title | scenics | onboard | poststd | postcover | contact | detail | timezone | people_num |
| -- |

| time | update_time | attach_imgs | has_send_letter | comment_cnt | start_date | end_date | status |
| -- |

## qy_company_square [static]

| id | company_id | time |
| -- |

## qy_contact_ban [static]

| id | contact | time | days | reason_type |
| -- |
| | 被禁的联系方式 | 禁止开始时间 | 禁止天数| 1: 广告或垃圾信息； 2: 色情低俗内容； 3: 激进时政或意识形态话题； 4: 对他人人身攻击 0: 其他 |

## qy_content_payflow 支付表

| trade_id | uid | recv_uid | object_id | object_type | pay_type | amount | status | time |
| -- |
| trade_id | 付款方 | 收款方 | object_id | object_type | 支付类型 | 金额 单位为 分 | status | time |

## qy_draft

| id | draft_id | uid | title | content | tag | time |
| -- |
| id | 草稿id | uid | title | 文章内容 | 文章类型 | time |

## qy_editor_choices

| id | pid | post_time | slider_cover | editor_cover | editor_title | title_location | title_color | time |
| -- |
| id | 文章id | post_time | 轮播图 | 编辑推荐图 | 编辑标题 | 标题位置 | 标题颜色 RGB 16 色 如 FFFFFF | time |

## qy_email_to_uid

| sid | email | uid | hash | time |
| -- |
| 自增主键 | email | uid | hash | time |

## qy_invite

| id | uid | inviter_uid | time |
| -- |
| id | uid | inviter_uid | 设置邀请人时间 |

## qy_letter

| letter_id | last_msg_id | unread_msg_num | msg_num |
| -- |
| letter_id | 最后一条msg的id | 该letter里未读msg数 | 该letter里msg总数 |

## qy_msg

| msg_id | time | msg_type | content | from_uid | to_uid |
| -- |
| msg_id | time | msg类型 | 私信内容 | 发信方 | 收信方 |

## qy_name_to_uid

| id | name | hash | uid |
| -- |
| 自增 | 用户姓名 | 用户姓名hash值 | uid |

## qy_post

- 当评论并且转发一篇 POST A 时，会生成 评论 C 和新 POST B

| pid | uid | tags | at_users | title | content | summary | poststd | postthumb | postcover | time | update_time |
| -- |
| pid | uid | [tag1,tag2] | [@uid1, @uid2 ] | title | 文章内容 | 文章摘要 | 标准图 | 缩略图| 封面图 | time | update_time |

| ref_pid | ref_uid | as_comment_id | status | repost_cnt | enshrine_cnt | praise_cnt | system_post | related | 
| -- |
| 被转发的文章id | ref_pid 的 uid | 转发文对应的评论id | status | 被转发次数 | 被收藏次数 | 被点赞次数 | 是否系统post | 相关文章 | 

## qy_praise

| id | praise_id | launch_uid | recv_uid | object_type | object_id | status | time |
| -- |
| 自增id | 点赞id | 点赞发起人 | 被点赞用户id | 0 post 1comment 2answer | object_id | 0=正常, 1=被取消 | 点赞或取消点赞时的时间 |

## qy_product_cmt

| cid | uid | product_id | product_type | product_uid | parent_cid | parent_uid | content | time | update_time | status |
| -- |
| 评论id | uid | product_id | product_type | product_uid | 父评论id | 父评论uid | content | time | update_time |0正常 1删除     |

## qy_punish

| id | |
| -- |
| uid | 被处罚用户uid |
| object_type |  举报类型 取值 post : 0 , comment : 1 , product_cmt : 2 , qa : 3 ,company : 4 , msg : 5 , user : 6 |
| object_vertical_type | 举报细分类型 object_type = 2 时 取 1 为结伴 2 为答案 object_type 为 3 时 : 取0为问题 1为答案 , 其他 默认0 |
| time | 处罚开始时间 | 
| days | 处罚天数 |
| reason_type | 举报原因类型 1: 广告或垃圾信息； 2: 色情低俗内容； 3: 激进时政或意识形态话题； 4: 对他人人身攻击 0: 其他 |
| comment | 其他理由 |

## qy_report

| id | |
| -- |
| object_id | 被举报内容对象id |
| object_type | 举报类型 取值 post : 0 , comment : 1 , product_cmt : 2 , qa : 3 ,company : 4 , msg : 5 , user : 6 |
| object_vertical_type | 举报细分类型 object_type = 2 时 取 1 为结伴 2 为答案 object_type 为 3 时 : 取0为问题 1为答案 , 其他 默认0 |
| rel_object_id | 被举报相关内容id 当object_type取值为1时，取值为该comment对应的文章的id； 当object_type取值为2且object_vertical_type取值为1时，取对应的结伴id； 当object_type取值为2且object_vertical_type取值为2时，取对应的答案id； 其他任何情况，默认取值为：0. |
| from_uid | 举报发起人 |
| to_uid | 被举报人 |
| reason_type | 举报原因类型 1: 广告或垃圾信息； 2: 色情低俗内容； 3: 激进时政或意识形态话题； 4: 对他人人身攻击 0: 其他 |
| comment | 用户输入的附加信息 |
| time | 举报时间 |
| status | 处理状态 0 尚未处理，1 已处理 已处罚，2 已处理 结果不属实 |

## qy_scenic_location

| id | sid | pid | depth | sname | latitude | longitude | ne_lat | ne_long | homebroad |
| -- |

| time | nearby_scenics | english_name | raw_img | scenecover | scenestd | scenethumb | banner | fans_num |
| -- |

## qy_slider_show

| id | pid | show_cover | show_title | title_location | title_color | time | post_time |
| -- |

## qy_startup_logo

| id | title | url | img | time | status |
| -- |

## qy_theme_scenic

| id | month | theme | scenics |
| -- |

## qy_third_to_uid
| id |third_id | | hash | id_type | access_token | refresh_token | name | user_mini |
| -- |

## qy_today_topic

| id | pid | topic_cover | topic_title | time |
| -- |
| id | pid | 话题封面图 | 话题标题 | time |

## qy_topic

| topic_id | name | description | leader | img_cover | post_num | fans_num | time |
| -- |
| topic_id | 话题名称 | 话题描述 | 话题主持人uid | 话题封面 | 话题文章数量 | 话题粉丝数量 | 插入时间 |

## qy_topic_apply

| topic_id | apply_uid | reason | time |
| -- |
| topic_id | 申请人uid | 申请理由 | 插入时间 |

## qy_topic_square

| id | topic_id | time |
| -- |

## qy_topic_to_id

| id | name | topic_id | hash |
| -- |

## qy_user

| uid | weixin_third_id | qq_third_id | weibo_third_id | email | password | name | wallpaper |
| -- |
| uid | 微信第三方登录union ID | qq第三方登录id | 微博第三方登录id | email | password | 昵称 | 头像背景图 |

| raw_img | usercover | userthumb | usermini | is_kol | is_cert | reg_time | last_online_time |
| -- |
| 原图 | 用户封面图 | 用户缩略图 | 用户迷你图 | 是否青驿旅行家 1是 | 是否认证用户 1是 | 注册时间 | 最后在线时间 |

| fans_num | follow_num | all_post_num | travellog_num | roadmap_num | discussion_num |
| -- |
| 粉丝数 | 关注数(旅行地和粉丝) | 所有post数 | 游记数 | 攻略数 | 讨论数 |

| advertise_num | purchase_num | comment_num | province | city | gender | description | phone | 
| -- |
| 广告数 | 购买数 | 发表过的评论数 | 省份 | 城市 | 性别 | 描述 | 电话 |

| unread_comment_num | unread_fans_num | unread_atme_num | unread_msg_num | unread_cmt_atme_num |
| -- |
| 未读文章评论数 | 未读新增粉丝数 | 未读@我数 | 未读消息数 | 未读评论@我数 |

| unread_product_cmt_num | unread_inviteme_num | unread_answerme_num | unread_praise |
| -- |
| 未读结伴/答案评论数 | 未读邀请我数 | 未读回答我数 | 未读点赞我数 |

## qy_user_device

| id | uid | push_id | device_id | device_model | os_type | os_info | online | push_type | app_ver | time |
| -- |
| id | uid | push_id | device_id | device_model | 1an 2ios | os_info | online | push_type | app版本 | time |

## qy_user_location

| id | uid | latitude | longitude | geohash | latest_located_at |
| -- |

## qy_user_on_register

| id | uid | name | vip |
| -- |
| id | uid | name | 注册时是否推荐该用户 |

## qy_qa

- `scenics` 字段，json字符串，存的是该问题关联的旅行地，答案是没有存关联旅行地的，但redis数据`scenic2qa`存的是`qa_id`,包括了问题和答案

| qa_id | type | uid | title | summary | content | reply_num | parent_id | imagecover |
| -- |
| 问题id 或者 答案id  | 0问题 1答案 | uid | title | summary | content |问题:答案数量 答案:评论数量 | 问题id,答案才有 | imagecover |

| pay_beopen | pay_amount | pay_times | scenics | invite_users | invite_pay_amount | pay_received |
| -- |
| 0不开通 1开通打赏 | 打赏金额 | 打赏次数 | 关联的旅行地 | 邀请回答的用户 | 邀请金额 | 0悬赏未领取 1已经领取 |

| status | praise_cnt | time | update_time | invite_pay_type | has_send_letter |
| -- |
|0正常 1删除 | 点赞数 | time | update_time | invite_pay_type | 是否发送过私信通知用户 |

## qy_qa_square

| id | qa_id | time |
| -- |
| id | qa_id | time |

## qy_question_square

| id | question_id | time |
| -- |
| id | question_id | time |

## qy_recall_record [废弃]

- 老用户短信召回功能的表，应该没啥用了

| uid | phone | last_online_time | fans_num | discussion_num | long_post_num | unread_num | last_sms_time | sms_cnt
| -- |

## qy_rec_guide

| id | pid | time |
| -- |
| id | 文章id | 推荐时间 |

## qy_rec_note

| id | pid | time |
| -- |
| id | pid | time |

## qy_rec_scenic

| id | sid | time |
| -- |
| id | sid | time |

## qy_rec_user

| id | uid | time |
| -- |
| id | uid | time |

## qy_reg_pay

| id | uid | pay_time | money |
| -- |
| id | uid | 支付时间 | 支付金额 单位: 分 |

## qy_withdraw_flow 申请提现表

| id | trade_id | uid | withdraw_type | apply_amount | withdraw_amount | status | time | 
| -- |
| id | trade_id | 申请者 | withdraw_type | 申请金额 | 实际退款金额 | status | time | 

## qy_system_order

| trade_id | uid | recv_uid | object_id | object_type | pay_type | amount | pay_status | trade_status | time |
| -- |
| trade_id | 付款方 | 收款方 | object_id | object_type | 支付类型 | 金额 单位为 分  | 支付状态 | 交易状态 | time |

## qy_wallet

| uid | wx_openid | qy_balance | qy_withdraw_today | prepay_balance |
| -- |
| uid | wx_openid | 青驿币余额 | 青驿币当日可提现额度 | prepay_balance |

| wxpay_balance | wxpay_withdraw_all | wxpay_withdraw_doday | wxpay_withdraw_already |
| -- |
| 微信余额 | 微信累积可提现额度 | 微信当日可提现额度 | 微信累积已提现额度 |

| alipay_balance | alipay_withdraw_all | alipay_withdraw_today | alipay_withdraw_already |
| -- |
| 支付宝余额 | 支付宝累积可提现额度  | 支付宝当日可提现额度  | 支付宝累积已提现额度 |

## qy_post_pay

| pid | amount | pay_times |
| -- |
