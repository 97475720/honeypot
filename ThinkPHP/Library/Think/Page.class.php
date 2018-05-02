<?php
//// +----------------------------------------------------------------------
//// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
//// +----------------------------------------------------------------------
//// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
//// +----------------------------------------------------------------------
//// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
//// +----------------------------------------------------------------------
//// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
//// +----------------------------------------------------------------------
//namespace Think;
//
//class Page{
//    public $firstRow; // 起始行数
//    public $listRows; // 列表每页显示行数
//    public $parameter; // 分页跳转时要带的参数
//    public $totalRows; // 总行数
//    public $totalPages; // 分页总页面数
//    public $rollPage   = 11;// 分页栏每页显示的页数
//	public $lastSuffix = true; // 最后一页是否显示总页数
//
//    private $p       = 'p'; //分页参数名
//    private $url     = ''; //当前链接URL
//    private $nowPage = 1;
//
//	// 分页显示定制
//    private $config  = array(
//        'header' => '<span class="rows">共 %TOTAL_ROW% 条记录</span>',
//        'prev'   => '<<',
//        'next'   => '>>',
//        'first'  => '1...',
//        'last'   => '...%TOTAL_PAGE%',
//        'theme'  => '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
//    );
//
//    /**
//     * 架构函数
//     * @param array $totalRows  总的记录数
//     * @param array $listRows  每页显示记录数
//     * @param array $parameter  分页跳转的参数
//     */
//    public function __construct($totalRows, $listRows=20, $parameter = array()) {
//        C('VAR_PAGE') && $this->p = C('VAR_PAGE'); //设置分页参数名称
//        /* 基础设置 */
//        $this->totalRows  = $totalRows; //设置总记录数
//        $this->listRows   = $listRows;  //设置每页显示行数
//        $this->parameter  = empty($parameter) ? $_GET : $parameter;
//        $this->nowPage    = empty($_GET[$this->p]) ? 1 : intval($_GET[$this->p]);
//        $this->nowPage    = $this->nowPage>0 ? $this->nowPage : 1;
//        $this->firstRow   = $this->listRows * ($this->nowPage - 1);
//    }
//
//    /**
//     * 定制分页链接设置
//     * @param string $name  设置名称
//     * @param string $value 设置值
//     */
//    public function setConfig($name,$value) {
//        if(isset($this->config[$name])) {
//            $this->config[$name] = $value;
//        }
//    }
//
//    /**
//     * 生成链接URL
//     * @param  integer $page 页码
//     * @return string
//     */
//    private function url($page){
//        return str_replace(urlencode('[PAGE]'), $page, $this->url);
//    }
//
//    /**
//     * 组装分页链接
//     * @return string
//     */
//    public function show() {
//        if(0 == $this->totalRows) return '';
//
//        /* 生成URL */
//        $this->parameter[$this->p] = '[PAGE]';
//        $this->url = U(ACTION_NAME, $this->parameter);
//        /* 计算分页信息 */
//        $this->totalPages = ceil($this->totalRows / $this->listRows); //总页数
//        if(!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
//            $this->nowPage = $this->totalPages;
//        }
//
//        /* 计算分页临时变量 */
//        $now_cool_page      = $this->rollPage/2;
//		$now_cool_page_ceil = ceil($now_cool_page);
//		$this->lastSuffix && $this->config['last'] = $this->totalPages;
//
//        //上一页
//        $up_row  = $this->nowPage - 1;
//        $up_page = $up_row > 0 ? '<a class="prev" href="' . $this->url($up_row) . '">' . $this->config['prev'] . '</a>' : '';
//
//        //下一页
//        $down_row  = $this->nowPage + 1;
//        $down_page = ($down_row <= $this->totalPages) ? '<a class="next" href="' . $this->url($down_row) . '">' . $this->config['next'] . '</a>' : '';
//
//        //第一页
//        $the_first = '';
//        if($this->totalPages > $this->rollPage && ($this->nowPage - $now_cool_page) >= 1){
//            $the_first = '<a class="first" href="' . $this->url(1) . '">' . $this->config['first'] . '</a>';
//        }
//
//        //最后一页
//        $the_end = '';
//        if($this->totalPages > $this->rollPage && ($this->nowPage + $now_cool_page) < $this->totalPages){
//            $the_end = '<a class="end" href="' . $this->url($this->totalPages) . '">' . $this->config['last'] . '</a>';
//        }
//
//        //数字连接
//        $link_page = "";
//        for($i = 1; $i <= $this->rollPage; $i++){
//			if(($this->nowPage - $now_cool_page) <= 0 ){
//				$page = $i;
//			}elseif(($this->nowPage + $now_cool_page - 1) >= $this->totalPages){
//				$page = $this->totalPages - $this->rollPage + $i;
//			}else{
//				$page = $this->nowPage - $now_cool_page_ceil + $i;
//			}
//            if($page > 0 && $page != $this->nowPage){
//
//                if($page <= $this->totalPages){
//                    $link_page .= '<a class="num" href="' . $this->url($page) . '">' . $page . '</a>';
//                }else{
//                    break;
//                }
//            }else{
//                if($page > 0 && $this->totalPages != 1){
//                    $link_page .= '<span class="current">' . $page . '</span>';
//                }
//            }
//        }
//
//        //替换分页内容
//        $page_str = str_replace(
//            array('%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%'),
//            array($this->config['header'], $this->nowPage, $up_page, $down_page, $the_first, $link_page, $the_end, $this->totalRows, $this->totalPages),
//            $this->config['theme']);
//        return "<div>{$page_str}</div>";
//    }
//}


namespace Think;
class Page
{

    // 分页栏每页显示的页数
    public $rollPage = 5;
    // 页数跳转时要带的参数
    public $parameter;
    // 分页URL地址
    public $url = '';
    // 默认列表每页显示行数
    public $listRows = 20;
    // 起始行数
    public $firstRow;
    // 分页总页面数
    protected $totalPages;
    // 总行数
    protected $totalRows;
    // 当前页数
    protected $nowPage;
    // 分页的栏的总页数
    protected $coolPages;
    // 分页显示定制
    protected $config = array('header' => '条记录', 'prev' => '上一页', 'next' => '下一页', 'first' => '第一页', 'last' => '<span id="lastspan">最后一页</span>', 'theme' => '<ul><li><span> %totalRow% %header% %nowPage%/%totalPage% 页</span></li> %first%  %upPage% %prePage%  %linkPage% %downPage%  %nextPage% %end%</ul>');
    // 默认分页变量名
    protected $varPage;

    /**
     * 架构函数
     * @access public
     * @param array $totalRows 总的记录数
     * @param array $listRows 每页显示记录数
     * @param array $parameter 分页跳转的参数
     */
    public function __construct($totalRows, $listRows = '', $parameter = '', $url = '')
    {
        $this->totalRows = $totalRows;
        $this->parameter = $parameter;
        $this->varPage = C('VAR_PAGE') ? C('VAR_PAGE') : 'p';
        if (!empty($listRows)) {
            $this->listRows = intval($listRows);
        }
        $this->totalPages = ceil($this->totalRows / $this->listRows);     //总页数
        $this->coolPages = ceil($this->totalPages / $this->rollPage);
        $this->nowPage = !empty($_GET[$this->varPage]) ? intval($_GET[$this->varPage]) : 1;
        if ($this->nowPage < 1) {
            $this->nowPage = 1;
        } elseif (!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
            $this->nowPage = $this->totalPages;
        }
        $this->firstRow = $this->listRows * ($this->nowPage - 1);
        if (!empty($url)) $this->url = $url;
    }

    public function setConfig($name, $value)
    {
        if (isset($this->config[$name])) {
            $this->config[$name] = $value;
        }
    }

    /**
     * 分页显示输出
     * @access public
     */
    public function show()
    {
        if (0 == $this->totalRows) return '';
        $p = $this->varPage;
        $nowCoolPage = ceil($this->nowPage / $this->rollPage);
        // 分析分页参数
        if ($this->url) {
            $depr = C('URL_PATHINFO_DEPR');
            $url = rtrim(U('/' . $this->url, '', false), $depr) . $depr . '__PAGE__';
        } else {
            if ($this->parameter && is_string($this->parameter)) {
                parse_str($this->parameter, $parameter);
            } elseif (is_array($this->parameter)) {
                $parameter = $this->parameter;
            } elseif (empty($this->parameter)) {
                unset($_GET[C('VAR_URL_PARAMS')]);
                $var = !empty($_POST) ? $_POST : $_GET;
                if (empty($var)) {
                    $parameter = array();
                } else {
                    $parameter = $var;
                }
            }
            $parameter[$p] = '__PAGE__';
            $url = U('', $parameter);
        }
        //上下翻页字符串
        $upRow = $this->nowPage - 1;
        $downRow = $this->nowPage + 1;
        if ($upRow > 0) {
            $upPage = "<li><a href='" . str_replace('__PAGE__', $upRow, $url) . "'>" . $this->config['prev'] . "</a></li>";
        } else {
            $upPage = '';
        }
        if ($downRow <= $this->totalPages) {
            $downPage = "<li><a href='" . str_replace('__PAGE__', $downRow, $url) . "'>" . $this->config['next'] . "</a></li>";
        } else {
            $downPage = '';
        }
        // << < > >>
        if ($nowCoolPage == 1) {
            $theFirst = '';
            $prePage = '';
        } else {
            $preRow = $this->nowPage - $this->rollPage;
            $prePage = "<li><a href='" . str_replace('__PAGE__', $preRow, $url) . "' >上" . $this->rollPage . "页</a></li>";
            $theFirst = "<li><a href='" . str_replace('__PAGE__', 1, $url) . "' >" . $this->config['first'] . "</a></li>";
        }
        if ($nowCoolPage == $this->coolPages) {
            $nextPage = '';
            $theEnd = '';
        } else {
            $nextRow = $this->nowPage + $this->rollPage;
            $theEndRow = $this->totalPages;
            $nextPage = "<li><a href='" . str_replace('__PAGE__', $nextRow, $url) . "' >下" . $this->rollPage . "页</a></li>";
            $theEnd = "</li><a href='" . str_replace('__PAGE__', $theEndRow, $url) . "' >" . $this->config['last'] . "</a></li>";
        }
        // 1 2 3 4 5
        $linkPage = "";
        for ($i = 1; $i <= $this->rollPage; $i++) {
            $page = ($nowCoolPage - 1) * $this->rollPage + $i;
            if ($page != $this->nowPage) {
                if ($page <= $this->totalPages) {
                    $linkPage .= "<li><a href='" . str_replace('__PAGE__', $page, $url) . "'>" . $page . "</a></li>";
                } else {
                    break;
                }
            } else {
                if ($this->totalPages != 1) {
                    $linkPage .= "<li><span class='current'>" . $page . "</span></li>";
                }
            }
        }
        $pageStr = str_replace(
            array('%header%', '%nowPage%', '%totalRow%', '%totalPage%', '%upPage%', '%downPage%', '%first%', '%prePage%', '%linkPage%', '%nextPage%', '%end%'),
            array($this->config['header'], $this->nowPage, $this->totalRows, $this->totalPages, $upPage, $downPage, $theFirst, $prePage, $linkPage, $nextPage, $theEnd), $this->config['theme']);
        return $pageStr;
    }
}
