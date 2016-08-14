
--批量更改表前缀
Select CONCAT( 'ALTER TABLE ', table_name, ' RENAME TO ', replace(table_name,'zc_','zc_'),';')
from information_schema.tables
where TABLE_SCHEMA = 'zc' and table_name LIKE 'zc_%';

--批量更改表前缀
ALTER TABLE zc_account_log RENAME TO zc_account_log;
ALTER TABLE zc_ad_manage RENAME TO zc_ad_manage;
ALTER TABLE zc_ad_position RENAME TO zc_ad_position;
ALTER TABLE zc_address RENAME TO zc_address;
ALTER TABLE zc_admin RENAME TO zc_admin;
ALTER TABLE zc_admin_role RENAME TO zc_admin_role;
ALTER TABLE zc_announcement RENAME TO zc_announcement;
ALTER TABLE zc_areas RENAME TO zc_areas;
ALTER TABLE zc_article RENAME TO zc_article;
ALTER TABLE zc_article_category RENAME TO zc_article_category;
ALTER TABLE zc_attr RENAME TO zc_attr;
ALTER TABLE zc_attr_value RENAME TO zc_attr_value;
ALTER TABLE zc_attribute RENAME TO zc_attribute;
ALTER TABLE zc_bill RENAME TO zc_bill;
ALTER TABLE zc_brand RENAME TO zc_brand;
ALTER TABLE zc_brand_category RENAME TO zc_brand_category;
ALTER TABLE zc_category RENAME TO zc_category;
ALTER TABLE zc_category_attr_map RENAME TO zc_category_attr_map;
ALTER TABLE zc_category_attr_val_map RENAME TO zc_category_attr_val_map;
ALTER TABLE zc_collection_doc RENAME TO zc_collection_doc;
ALTER TABLE zc_commend_goods RENAME TO zc_commend_goods;
ALTER TABLE zc_comment RENAME TO zc_comment;
ALTER TABLE zc_delivery RENAME TO zc_delivery;
ALTER TABLE zc_delivery_doc RENAME TO zc_delivery_doc;
ALTER TABLE zc_delivery_extend RENAME TO zc_delivery_extend;
ALTER TABLE zc_discussion RENAME TO zc_discussion;
ALTER TABLE zc_email_registry RENAME TO zc_email_registry;
ALTER TABLE zc_expresswaybill RENAME TO zc_expresswaybill;
ALTER TABLE zc_favorite RENAME TO zc_favorite;
ALTER TABLE zc_find_password RENAME TO zc_find_password;
ALTER TABLE zc_freight_company RENAME TO zc_freight_company;
ALTER TABLE zc_good_attr_val_map RENAME TO zc_good_attr_val_map;
ALTER TABLE zc_goods RENAME TO zc_goods;
ALTER TABLE zc_goods_attribute RENAME TO zc_goods_attribute;
ALTER TABLE zc_goods_car RENAME TO zc_goods_car;
ALTER TABLE zc_goods_photo RENAME TO zc_goods_photo;
ALTER TABLE zc_goods_photo_relation RENAME TO zc_goods_photo_relation;
ALTER TABLE zc_group_price RENAME TO zc_group_price;
ALTER TABLE zc_guide RENAME TO zc_guide;
ALTER TABLE zc_help RENAME TO zc_help;
ALTER TABLE zc_help_category RENAME TO zc_help_category;
ALTER TABLE zc_keyword RENAME TO zc_keyword;
ALTER TABLE zc_log_error RENAME TO zc_log_error;
ALTER TABLE zc_log_operation RENAME TO zc_log_operation;
ALTER TABLE zc_log_sql RENAME TO zc_log_sql;
ALTER TABLE zc_marketing_sms RENAME TO zc_marketing_sms;
ALTER TABLE zc_member RENAME TO zc_member;
ALTER TABLE zc_merch_ship_info RENAME TO zc_merch_ship_info;
ALTER TABLE zc_message RENAME TO zc_message;
ALTER TABLE zc_model RENAME TO zc_model;
ALTER TABLE zc_notify_registry RENAME TO zc_notify_registry;
ALTER TABLE zc_oauth RENAME TO zc_oauth;
ALTER TABLE zc_oauth_user RENAME TO zc_oauth_user;
ALTER TABLE zc_online_recharge RENAME TO zc_online_recharge;
ALTER TABLE zc_order RENAME TO zc_order;
ALTER TABLE zc_order_goods RENAME TO zc_order_goods;
ALTER TABLE zc_order_log RENAME TO zc_order_log;
ALTER TABLE zc_payment RENAME TO zc_payment;
ALTER TABLE zc_plugin RENAME TO zc_plugin;
ALTER TABLE zc_point_log RENAME TO zc_point_log;
ALTER TABLE zc_products RENAME TO zc_products;
ALTER TABLE zc_promotion RENAME TO zc_promotion;
ALTER TABLE zc_prop RENAME TO zc_prop;
ALTER TABLE zc_quick_naviga RENAME TO zc_quick_naviga;
ALTER TABLE zc_refer RENAME TO zc_refer;
ALTER TABLE zc_refundment_doc RENAME TO zc_refundment_doc;
ALTER TABLE zc_regiment RENAME TO zc_regiment;
ALTER TABLE zc_relation RENAME TO zc_relation;
ALTER TABLE zc_right RENAME TO zc_right;
ALTER TABLE zc_search RENAME TO zc_search;
ALTER TABLE zc_seller RENAME TO zc_seller;
ALTER TABLE zc_seller_message RENAME TO zc_seller_message;
ALTER TABLE zc_spec RENAME TO zc_spec;
ALTER TABLE zc_spec_photo RENAME TO zc_spec_photo;
ALTER TABLE zc_suggestion RENAME TO zc_suggestion;
ALTER TABLE zc_takeself RENAME TO zc_takeself;
ALTER TABLE zc_ticket RENAME TO zc_ticket;
ALTER TABLE zc_user RENAME TO zc_user;
ALTER TABLE zc_user_group RENAME TO zc_user_group;
ALTER TABLE zc_withdraw RENAME TO zc_withdraw;

--商品属性值关联查询
SELECT *
FROM `shop`.`zc_goods_attr_val_map` AS a, `shop`.`zc_goods_attr_val_map` AS b
WHERE b.vid = a.vid AND b.aid = 1 AND a.id = 6