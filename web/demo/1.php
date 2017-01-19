<style>
.box{
    width: 1200px;
    height: 1200px;       /* 决定显示框的大小 */
    margin: 50px;
    border: 50px solid rgba(1,1,1,0.5);
    padding: 50px;
    /*overflow: hidden;*/
    background-color: white;
    border-radius: 10px;
}
.background{
    background-image: url(/img/linyicheng.jpg),url(/img/quanzhixian.jpg);
    background-origin: border-box,border-box; /* border-box|padding-box|content-box */
    background-repeat: no-repeat; /* 决定图片的是否重复 */
    /* background-size: 100% 100%; /* 决定图片的大小 cover 覆盖整个容器　contain 一边碰触到边缘*/
    background-position: 0px 0px,10px 100px; /* 图片偏移量 */
}
</style>
<div class="box background"></div>
