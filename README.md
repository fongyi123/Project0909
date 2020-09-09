# Project0909

一．氣象局那個個案，可以在搜尋到哪比資料的同時匯進mysql，至於不先把資料抓下來放，是考慮到效能，比較不會拖慢去用者查詢的時間－－－已完成

二．網銀那個個案，今天已完成介面框架和會員登入與註冊與存款提款與查詢餘額明細功能連資料庫－－－已完成

三．購物車那個案，會員與管理員的登入、註冊、訂單查詢、資料庫表單、商品上架、商品選購、我的購物車的數量與總計的送出訂單與會員管理已完成，
－－－已完成


四．已更正的bug與新增的功能有：

    09/08:
    １．已更正氣象局縣市特色圖片無法切換的問題
    ２．已更正購物車商品無法編輯的問題
    ３．已更正網銀和購物車之登入與註冊頁的回首頁按鈕無法跳轉的問題
    ４．已更正購物車按加入購物車，如果已經有同樣商品直接在那項商品數量增加，不有會有重複相同商品出現在列表

    09/09:
    １．已新增網銀顯示餘額與隱藏餘額的功能－－－>加分題
    ２．已更正購物車會員端在首頁點擊我的購物車與商品選購沒有登入就可以進入該頁面的問題
    ３．已更正三個個案所有頁面網頁標題
    ４．已新增三個個案所有頁面的程式碼註解






氣象局資料庫：
create database OPENDATA

CREATE TABLE weather(
	`datasetDescription` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `locationName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `elementName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `startTime` datetime COLLATE utf8_unicode_ci NOT NULL,
    `endTime` datetime COLLATE utf8_unicode_ci NOT NULL,
    `value` varchar(100) COLLATE utf8_unicode_ci NOT NULL
)

CREATE TABLE weathertwodays(
	`datasetDescription` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `locationName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `elementName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `startTime` datetime COLLATE utf8_unicode_ci NOT NULL,
    `endTime` datetime COLLATE utf8_unicode_ci NOT NULL,
    `value` varchar(100) COLLATE utf8_unicode_ci NOT NULL
)

CREATE TABLE weathernow(
	`datasetDescription` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `locationName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `elementName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `startTime` datetime COLLATE utf8_unicode_ci NOT NULL,
    `endTime` datetime COLLATE utf8_unicode_ci NOT NULL,
    `parameterName` varchar(100) COLLATE utf8_unicode_ci NOT NULL
)

CREATE TABLE weatherrain(
	`locationName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `obsTime` datetime COLLATE utf8_unicode_ci NOT NULL,
    `elementName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `elementValue` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `parameterName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `parameterValue` varchar(100) COLLATE utf8_unicode_ci NOT NULL 
)


網銀資料庫：
create database bankmember

CREATE TABLE member(
	`mid` int(15) COLLATE utf8_unicode_ci NOT NULL,
    `mname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `musername` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `mpasswd` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `msex` ENUM('男','女') COLLATE utf8_unicode_ci NOT NULL,
    `mbirthday` date COLLATE utf8_unicode_ci NOT NULL,
    `mstatus` ENUM('normal','Disable') COLLATE utf8_unicode_ci NOT NULL,
    `memail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `mphone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `maddress` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `mlog` int(20) COLLATE utf8_unicode_ci NOT NULL
)
create table detail
(
    did int auto_increment primary key,
    daccount varchar(50),
    dtranstype varchar(50),
    dtrade int,
    dtransdate datetime
);


購物車資料庫

create database shopping

create table manager
(
    maid int auto_increment primary key,
    maaccount varchar(50),
    mapassword varchar(50)

);

CREATE TABLE member(
	`meid` int(50) auto_increment primary key,
    `mename` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `meaccount` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `mepasswd` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `mebirthday` date COLLATE utf8_unicode_ci NOT NULL,
    `mestatus` ENUM('normal','Disable') COLLATE utf8_unicode_ci NOT NULL,
    `memail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `mephone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `meaddress` varchar(100) COLLATE utf8_unicode_ci NOT NULL
)

create table product
(
    prid int(30) auto_increment primary key,
    prname varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    prprice int(20) COLLATE utf8_unicode_ci NOT NULL,
    prquantity int(50) COLLATE utf8_unicode_ci NOT NULL,
    prdescript varchar(150) COLLATE utf8_unicode_ci NOT NULL,
    primg blob NOT NULL
);

create table orders
(
    orid int(50) auto_increment primary key,
    meaccount varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    caid int(30) COLLATE utf8_unicode_ci NOT NULL,
    prid int(20) COLLATE utf8_unicode_ci NOT NULL,
    prname varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    prprice int(20) COLLATE utf8_unicode_ci NOT NULL,
    caquantity int(50) COLLATE utf8_unicode_ci NOT NULL,
    prdescript varchar(150) COLLATE utf8_unicode_ci NOT NULL,
    primg blob NOT NULL,
    ordate datetime
    
)
create table cart
(
    caid int(30) auto_increment primary key,
    prid int(20) COLLATE utf8_unicode_ci NOT NULL,
    prname varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    prprice int(20) COLLATE utf8_unicode_ci NOT NULL,
    caquantity int(50) COLLATE utf8_unicode_ci NOT NULL,
    prquantity int(50) COLLATE utf8_unicode_ci NOT NULL,
    prdescript varchar(150) COLLATE utf8_unicode_ci NOT NULL,
    primg blob 
);
