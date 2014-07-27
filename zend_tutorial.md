# zendframework2 入门
## zend

##准备工作 LAMP
首先安装apache , mysql ,php, 安装方法省略

1. 确定你的apache 支持 `.htaccess`,就是设置AllowOverride参数
2. 安装composer
3. 按照zend官方的例子搭建个入门的程序
专辑管理，功能包括 1.专辑列表 2.对专辑进行增删改 .
DB结构+测试数据,DB名字为`zend_tutorial`
        CREATE TABLE album (
        id int(11) NOT NULL auto_increment,
        artist varchar(100) NOT NULL,
        title varchar(100) NOT NULL,
        PRIMARY KEY (id)
        );
        INSERT INTO album (artist, title)
            VALUES  ('The  Military  Wives',  'In  My  Dreams');
        INSERT INTO album (artist, title)
            VALUES  ('Adele',  '21');
        INSERT INTO album (artist, title)
            VALUES  ('Bruce  Springsteen',  'Wrecking Ball (Deluxe)');
        INSERT INTO album (artist, title)
            VALUES  ('Lana  Del  Rey',  'Born  To  Die');
        INSERT INTO album (artist, title)
            VALUES  ('Gotye',  'Making  Mirrors');

4. 使用composer 安装zendframework
`bash
composer.phar create-project -sdev --repository-url="https://packages.zendframework.com" \
zendframework/skeleton-application ./
`
上面的命令相当于从`https://github.com/zendframework/ZendSkeletonApplication` 把代码下载下来,
你也可以自己手动下载
再执行`
composer.phar self-update
composer.phar install
composer.phar update
`
如果使用的composer.phar create-project 安装的话，就不需要self-update install两步.

5. 配置apache
`
<VirtualHost *:80>
     ServerName zf2-tutorial.localhost
     DocumentRoot /var/www/html/zf2-tutorial/public
     SetEnv APPLICATION_ENV "development"
     <Directory /var/www/html/zf2-tutorial/public>
         DirectoryIndex index.php
         AllowOverride All
         Order allow,deny
         Allow from all
         </Directory>
 </VirtualHost>
`
/var/www/html/zf2-tutorial/public 这个目录一会就是项目安装完后就会有．
还要配置`.htaccess`,内容如下
`
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [NC,L]
`
6. 接下来你应该可以访问`http://zf2-tutorial.localhost`,当然先要配置hosts了

7. 接下来开始编码了,先copy官网的例子，后面再分析代码

首先Album模块的配置文件`module/Album/config/module.config.php`
`
array(
     'controllers' => array(
         'invokables' => array(
             'Album\Controller\Album' => 'Album\Controller\AlbumController',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'album' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/album[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Album\Controller\Album',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'album' => __DIR__ . '/../view',
         ),
     ),
 );
`
8. 接下来定义我们的controller,`Album/Controller/AlbumController.php`
`
 namespace Album\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;

 class AlbumController extends AbstractActionController
 {
     public function indexAction()
     {
     }

     public function addAction()
     {
     }

     public function editAction()
     {
     }

     public function deleteAction()
     {
     }
 }
`
完成这一步的话我们就可以再浏览器测试`http://zf2-tutorial.localhost/album`
应该可以看到错误提示
`Zend\View\Renderer\PhpRenderer::render: Unable to render template "album/album/index";`
9. 看到上面的错误说明我们的代码运行正常了,接下来自然就是添加模板文件
我们在添加文件`Album/view/album/album/index.phtml`
`
hello world
`
完成这一步的话我们就可以再浏览器测试`http://zf2-tutorial.localhost/album`
应该就能看到hello world 了
