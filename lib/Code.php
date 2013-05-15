<?php
/**
 * 生成二维码
 * logo 尺寸40*40
 */
class Code {
	/**
	 * 调用此方法
	 * @param  string $type 应用类型
	 * @param  int $id   应用id
	 * @param  string $text 需要生成的内容
	 * @return null       [description]
	 */
	public static function png($type,$id,$text) {
		$logofile=Y::get("config")->code->logo;
		$md5=md5($type.$id);
		$name=substr($md5, 0,2).'/'.substr($md5, 2,2).'/'.$md5.'.png';
		$path=Y::get("config")->code->path.'/';
		if(!file_exists($path.substr($md5, 0,2))){
			mkdir($path.substr($md5, 0,2),755);
		}
		if(!file_exists($path.substr($md5, 0,2).'/'.substr($md5, 2,2))){
			mkdir($path.substr($md5, 0,2).'/'.substr($md5, 2,2),755);
		}
		$filename=$path.$name;
		if(!file_exists($logofile)){
			return false;
		}
		//QRcode::png($text, $outfile = false, $level = QR_ECLEVEL_L, $size = 3, $margin = 4, $saveandprint=false)
		QRcode::png($text, $filename,"m",7,1);
		//获取所需要的尺寸
		$codePicInfo=getimagesize($filename);
		$logoInfo=getimagesize($logofile);
		$logo['width']=40/*floor($codePicInfo[0]/6)*/;
		$logo['height']=40/*floor($codePicInfo[1]/6)*/;
		$position=floor(($codePicInfo[0]-$logo['width'])/2);
		//创建新的logo图片
		$newLog=imagecreatefrompng($logofile);
		//获取二维码图片资源
		$newCode=imagecreatefrompng($filename);
		//合并logo和二维码
		//imagecopyresampled( $newCode, $newLog, $position, $position, 0, 0, $logo['width'], $logo['height'] , $logo['width'], $logo['height'] );
		self::imagecopymerge_alpha( $newCode, $newLog, $position, $position, 0, 0, $logo['width'], $logo['height'] , 5 );
		//生成图片
		imagepng( $newCode, $filename );
		//销毁资源
		imagedestroy($newCode);
		imagedestroy($newLog);
		return $name;
	}

	public static function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
        $opacity=$pct;
        // getting the watermark width
        $w = imagesx($src_im);
        // getting the watermark height
        $h = imagesy($src_im);

        // creating a cut resource
        $cut = imagecreatetruecolor($src_w, $src_h);
        // copying that section of the background to the cut
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
        // inverting the opacity
        $opacity = 100 - $opacity;

        // placing the watermark now
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $opacity);
}
}