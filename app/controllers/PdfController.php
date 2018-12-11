<?php 

class PdfController extends FPDF
{
	
	
	public function index($id=null)
    {
        header('location:'.URL_APP);
    }

    public function Header()
    {
        $direccion= URL_APP.'/img/sena.png';
        $this->Image($direccion,53,5,100);
        $this->setFont('Arial','B',12);
        $this->Ln(40);
    }


    public function Footer(Type $var = null)
    {
        $this->setY(-45);
        
        $this->setFont('Arial','I',8);
        $this->cell(0,10,'',0,1,'C');
        $this->cell(0,10,'',0,1,'C');
        
        $this->setFont('Arial','I',6);
        $this->cell(0,5,'Ministerio de trabajo',0,1,'C');

        $this->setFont('Arial','B',8);
        $this->cell(0,5,'SERVICIO NACIONAL DE APRENDIZAJE',0,1,'C');

        $this->setFont('Arial','I',6);
        $this->cell(0,5,'Avenida - Carrera 30 No. 17 B 25 sur   2do piso – PBX (57-1) 5960050 Bogotá, D.C. – Colombia, www.sena.edu.co',0,1,'C');

        $this->setFont('Arial','I',12);
        $this->cell(0,10,'pagina '.$this->PageNo(),0,0,'C');
    }
    
    public function novedades($novedad)
    {
        $this->AddPage();
        $this->setXY(80,40);
        $this->cell(120,10,'comite de seguimiento',0,1,'l');
        $this->setXY(40,50);
        $this->cell(120,10,'Acta No '.$novedad->id_novedad ,0,1,'C');
        $this->setFont('arial', '', 10);
        $this->cell(20, 8, 'Fecha:',0,0,'l' );
        $this->cell(100, 8, $novedad->fecha_inicio ,0,1,'l' );
        $this->cell(20, 8, 'Ficha:',0,0,'l' );
        $this->cell(30, 8, $novedad->fk_id_ficha,0,0,'l' );
        $this->cell(20, 8, 'Programa:',0,0,'l' );
        $this->cell(20, 8, $this->mostrar($novedad->programa_formacion),0,1,'l' );
        $this->cell(20, 8, 'jornada:',0,0,'l' );
        $this->cell(30, 8, $this->mostrar($novedad->jornada),0,0,'l' );
        $this->cell(20, 8, 'sede:',0,0,'l' );
        $this->cell(40, 8, $this->mostrar($novedad->sede),0,1,'l' );
        
        $y=$this->GetY();
        $this->setY($y+ 5);
        $this->setFont('Arial','B',10);
        $this->cell(0,12,'PARTICIPANTES EN EL COMITE',0,1,'l');

        /*
        * los dos coordinadores se dejan siempre ahí
        */
        $this->setFont('arial', '', 10);
        $this->cell(20, 8, utf8_decode('Coordinador Misional: Mario Rodríguez López'),0,0,'l' );
        $y=$this->GetY();
        $this->setY($y+ 5);
        $this->cell(20, 8, utf8_decode('Coordinador Académico: German Gilberto Alarcón'),0,0,'l' );

        $y=$this->GetY();
        $this->setY($y+10);
        $this->setFont('arial', 'b', 10);
        $this->cell(20, 8, utf8_decode('Aprendiz citado: '),0,0,'l' );

        $y=$this->GetY();
        $this->setY($y+10);
        $this->cell(46, 8, 'Nombre:',1,0,'l' );
        $this->cell(46, 8, 'Apellidos:',1,0,'l' );
        $this->cell(46, 8, 'Tipo de documento:',1,0,'l' );
        $this->cell(46, 8, 'Documento:',1,1,'l' );

        /*
        *datos del men
        */
        $this->setFont('arial', '', 10);
        $this->cell(46, 8, utf8_decode($this->mostrar($novedad->nombre)),1,0,'l' );
        $this->cell(46, 8, utf8_decode($this->mostrar($novedad->primer_apellido).' '.$this->mostrar($novedad->segundo_apellido)),1,0,'l' );
        $this->cell(46, 8, utf8_decode($this->mostrar($novedad->tipo_documento)),1,0,'l' );
        $this->cell(46, 8, utf8_decode($novedad->documento),1,1,'l' );
        // $this->multiCell(100, 5, 'vamo a darle',1,'C',0 );
        $y=$this->GetY();
        $this->setY($y+10);
        $this->cell(22, 8, 'motivo:',0,0,'l' );
        $this->multiCell(150, 8, utf8_decode($this->mostrar($novedad->motivo)),0,'l',0);

        /*
        *siempre es el mismo hecho 
        */
        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(22, 8, 'Hechos:',0,0,'l' );
        $this->multiCell(150, 8, 'El aprendiz radica solicitud de traslado de ficha',0,'l',0);

        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(22, 8, 'Comentarios:',0,0,'l' );
        $this->multiCell(150, 8, utf8_decode($this->mostrar($novedad->comentarios)),0,'l',0);

        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(33, 8, 'evidencias:',0,0,'l' );
        $this->multiCell(150, 8, utf8_decode($this->mostrar($novedad->evidencias)),0,'l',0);

        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(33, 8, 'Recomendaciones:',0,1,'l' );
        $this->cell(90, 8, 'Recomendaciones:',1,0,'l' );
        $this->cell(90, 8, 'Observaciones:',1,1,'l' );

        /*
        *datos del men
        */
        $this->setFont('arial', '', 10);
        $this->cell(90, 8, utf8_decode($this->mostrar($novedad->recomendaciones)),1,0,'l' );
        $this->cell(90, 8, 'Cambio a la ficha '.utf8_decode($this->mostrar($novedad->nueva_ficha)),1,1,'l' );
        
        
        

        // $this->AddPage();
        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(33, 8, utf8_decode('FIRMA PARTCIPANTES DEL COMITÉ:'),0,1,'l' );

        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(90, 8, 'NOMBRE',0,0,'l' );
        $this->cell(90, 8, 'FIRMA',0,1,'l' );


        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+4,$x+170,$y+4);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+8,$x+170,$y+8);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+12,$x+170,$y+12);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+16,$x+170,$y+16);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+20,$x+170,$y+20);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+24,$x+170,$y+24);
        

        $this->output();
    }

    public function novedad($novedad=[])
    {
        

        $this->AddPage();
        $this->setXY(80,40);
        $this->cell(120,10,'comite de seguimiento',0,1,'l');
        $this->setXY(40,50);
        $this->cell(120,10,'Acta No '.$novedad->id_novedad ,0,1,'C');
        $this->setFont('arial', '', 10);
        $this->cell(20, 8, 'Fecha:',0,0,'l' );
        $this->cell(100, 8, $novedad->fecha_inicio ,0,1,'l' );
        $this->cell(20, 8, 'Ficha:',0,0,'l' );
        $this->cell(30, 8, $novedad->fk_id_ficha,0,0,'l' );
        $this->cell(20, 8, 'Programa:',0,0,'l' );
        $this->cell(20, 8, utf8_decode($this->mostrar($novedad->programa_formacion)),0,1,'l' );
        $this->cell(20, 8, 'jornada:',0,0,'l' );
        $this->cell(30, 8, $this->mostrar($novedad->jornada),0,0,'l' );
        $this->cell(20, 8, 'sede:',0,0,'l' );
        $this->cell(40, 8, $this->mostrar($novedad->sede),0,1,'l' );
        
        $y=$this->GetY();
        $this->setY($y+ 5);
        $this->setFont('Arial','B',10);
        $this->cell(0,12,'PARTICIPANTES EN EL COMITE',0,1,'l');

        /*
        * los dos coordinadores se dejan siempre ahí
        */
        $this->setFont('arial', '', 10);
        $this->cell(20, 8, utf8_decode('Coordinador Misional: Mario Rodríguez López'),0,0,'l' );
        $y=$this->GetY();
        $this->setY($y+ 5);
        $this->cell(20, 8, utf8_decode('Coordinador Académico: German Gilberto Alarcón'),0,0,'l' );

        $y=$this->GetY();
        $this->setY($y+10);
        $this->setFont('arial', 'b', 10);
        $this->cell(20, 8, utf8_decode('Aprendiz citado: '),0,0,'l' );

        $y=$this->GetY();
        $this->setY($y+10);
        $this->cell(46, 8, 'Nombre:',1,0,'l' );
        $this->cell(46, 8, 'Apellidos:',1,0,'l' );
        $this->cell(46, 8, 'Tipo de documento:',1,0,'l' );
        $this->cell(46, 8, 'Documento:',1,1,'l' );

        /*
        *datos del men
        */
        $this->setFont('arial', '', 10);
        $this->cell(46, 8, utf8_decode($this->mostrar($novedad->nombre)),1,0,'l' );
        $this->cell(46, 8, utf8_decode($this->mostrar($novedad->primer_apellido).' '.$this->mostrar($novedad->segundo_apellido)),1,0,'l' );
        $this->cell(46, 8, utf8_decode($this->mostrar($novedad->tipo_documento)),1,0,'l' );
        $this->cell(46, 8, utf8_decode($novedad->documento),1,1,'l' );
        // $this->multiCell(100, 5, 'vamo a darle',1,'C',0 );
        $y=$this->GetY();
        $this->setY($y+10);
        $this->cell(22, 8, 'motivo:',0,0,'l' );
        $this->multiCell(150, 8, utf8_decode($this->mostrar($novedad->motivo)),0,'l',0);

        /*
        *siempre es el mismo hecho 
        */
        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(22, 8, 'Hechos:',0,0,'l' );
        $this->multiCell(150, 8, 'El aprendiz radica solicitud de traslado de ficha',0,'l',0);

        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(22, 8, 'Comentarios:',0,0,'l' );
        $this->multiCell(150, 8, utf8_decode($this->mostrar($novedad->comentarios)),0,'l',0);

        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(33, 8, 'evidencias:',0,0,'l' );
        $this->multiCell(150, 8, utf8_decode($this->mostrar($novedad->evidencias)),0,'l',0);

        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(33, 8, 'Recomendaciones:',0,0,'l' );
        $this->multiCell(150, 8, utf8_decode($this->mostrar($novedad->recomendaciones)),0,'l',0);
        
        

        // $this->AddPage();
        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(33, 8, utf8_decode('FIRMA PARTCIPANTES DEL COMITÉ:'),0,1,'l' );

        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(90, 8, 'NOMBRE',0,0,'l' );
        $this->cell(90, 8, 'FIRMA',0,1,'l' );


        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+4,$x+170,$y+4);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+8,$x+170,$y+8);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+12,$x+170,$y+12);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+16,$x+170,$y+16);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+20,$x+170,$y+20);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+24,$x+170,$y+24);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+28,$x+170,$y+28);
        

        $this->output();
    }

    public function PDFCambioJ($novedad=[])
    {
        $this->AddPage();
        $this->setXY(80,40);
        $this->cell(120,10,'comite de seguimiento',0,1,'l');
        $this->setXY(40,50);
        $this->cell(120,10,'Acta No '.$novedad->id_novedad ,0,1,'C');
        $this->setFont('arial', '', 10);
        $this->cell(20, 8, 'Fecha:',0,0,'l' );
        $this->cell(100, 8, $novedad->fecha_inicio ,0,1,'l' );
        $this->cell(20, 8, 'Ficha:',0,0,'l' );
        $this->cell(30, 8, $novedad->fk_id_ficha,0,0,'l' );
        $this->cell(20, 8, 'Programa:',0,0,'l' );
        $this->cell(20, 8, $this->mostrar($novedad->programa_formacion),0,1,'l' );
        $this->cell(20, 8, 'jornada:',0,0,'l' );
        $this->cell(30, 8, $this->mostrar($novedad->jornada),0,0,'l' );
        $this->cell(20, 8, 'sede:',0,0,'l' );
        $this->cell(40, 8, $this->mostrar($novedad->sede),0,1,'l' );
        
        $y=$this->GetY();
        $this->setY($y+ 5);
        $this->setFont('Arial','B',10);
        $this->cell(0,12,'PARTICIPANTES EN EL COMITE',0,1,'l');

        /*
        * los dos coordinadores se dejan siempre ahí
        */
        $this->setFont('arial', '', 10);
        $this->cell(20, 8, utf8_decode('Coordinador Misional: Mario Rodríguez López'),0,0,'l' );
        $y=$this->GetY();
        $this->setY($y+ 5);
        $this->cell(20, 8, utf8_decode('Coordinador Académico: German Gilberto Alarcón'),0,0,'l' );

        $y=$this->GetY();
        $this->setY($y+10);
        $this->setFont('arial', 'b', 10);
        $this->cell(20, 8, utf8_decode('Aprendiz citado: '),0,0,'l' );

        $y=$this->GetY();
        $this->setY($y+10);
        $this->cell(46, 8, 'Nombre:',1,0,'l' );
        $this->cell(46, 8, 'Apellidos:',1,0,'l' );
        $this->cell(46, 8, 'Tipo de documento:',1,0,'l' );
        $this->cell(46, 8, 'Documento:',1,1,'l' );

        /*
        *datos del men
        */
        $this->setFont('arial', '', 10);
        $this->cell(46, 8, utf8_decode($this->mostrar($novedad->nombre)),1,0,'l' );
        $this->cell(46, 8, utf8_decode($this->mostrar($novedad->primer_apellido).' '.$this->mostrar($novedad->segundo_apellido)),1,0,'l' );
        $this->cell(46, 8, utf8_decode($this->mostrar($novedad->tipo_documento)),1,0,'l' );
        $this->cell(46, 8, utf8_decode($novedad->documento),1,1,'l' );
        // $this->multiCell(100, 5, 'vamo a darle',1,'C',0 );
        $y=$this->GetY();
        $this->setY($y+10);
        $this->cell(22, 8, 'motivo:',0,0,'l' );
        $this->multiCell(150, 8, utf8_decode($this->mostrar($novedad->motivo)),0,'l',0);

        /*
        *siempre es el mismo hecho 
        */
        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(22, 8, 'Hechos:',0,0,'l' );
        $this->multiCell(150, 8, 'El aprendiz radica solicitud de traslado de ficha',0,'l',0);

        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(22, 8, 'Comentarios:',0,0,'l' );
        $this->multiCell(150, 8, utf8_decode($this->mostrar($novedad->comentarios)),0,'l',0);

        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(33, 8, 'evidencias:',0,0,'l' );
        $this->multiCell(150, 8, utf8_decode($this->mostrar($novedad->evidencias)),0,'l',0);

        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(33, 8, 'Recomendaciones:',0,1,'l' );
        $this->cell(90, 8, 'Recomendaciones:',1,0,'l' );
        $this->cell(90, 8, 'Observaciones:',1,1,'l' );

        /*
        *datos del men
        */
        $this->setFont('arial', '', 10);
        $this->cell(90, 8, utf8_decode($this->mostrar($novedad->recomendaciones)),1,0,'l' );
        $this->cell(90, 8, 'Cambio a la Jornada '.utf8_decode($this->mostrar($novedad->nueva_jornada)),1,1,'l' );
        
        
        

        // $this->AddPage();
        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(33, 8, utf8_decode('FIRMA PARTCIPANTES DEL COMITÉ:'),0,1,'l' );

        $y=$this->GetY();
        $this->setY($y+4);
        $this->cell(90, 8, 'NOMBRE',0,0,'l' );
        $this->cell(90, 8, 'FIRMA',0,1,'l' );


        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+4,$x+170,$y+4);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+8,$x+170,$y+8);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+12,$x+170,$y+12);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+16,$x+170,$y+16);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+20,$x+170,$y+20);
        $y=$this->GetY();
        $x=$this->Getx();
        $this->Line($x,$y+24,$x+170,$y+24);
        

        $this->output();
    }

    public function desercion($novedad=[])
    {
        $pdf = new fpdf();

        /* Muestra todo lo que este en el pdf */

        $pdf->AddPage();
        $pdf->SetFont('Arial','B',10);

        /*Cuadro de arriba*/

        $pdf->Image('img/Sena.PNG' , 25 ,10, 25 , 25,'PNG');
        $pdf->SetY(10);
        $pdf->SetX(25);
        $pdf->cell(25,25,'',1,1,'L');
        $pdf->SetY(10);
        $pdf->SetX(50);
        $pdf->cell(136,25,'',1,1,'L');
        $pdf->SetY(10);
        $pdf->SetX(55);
        $pdf->cell(136,25,'REPORTE DE DESERCION',0,0,'L');

        $pdf->SetY(35);
        $pdf->SetX(20);
        $pdf->cell(90,10,'NOMBRE DEL APRENDIZ: '.utf8_decode($this->mostrar($novedad->nombre).' '.$this->mostrar($novedad->primer_apellido).' '.$this->mostrar($novedad->segundo_apellido)),0,1,'L');
        $pdf->SetX(20);
        $pdf->cell(100,10,'DOCUMENTO DE IDENTIDAD:'.utf8_decode($this->mostrar($novedad->tipo_documento)),0,0,'L');
        

        /*Numero*/
        $pdf->SetXY(155,35);
        $pdf->cell(10,10,'No. '.utf8_decode($this->mostrar($novedad->id_novedad)),0,1,'L');


        $pdf->SetXY(120,45);
        $pdf->cell(10,10,'',0,1,'L');
        $pdf->SetX(20);
        $pdf->cell(90,10,utf8_decode('FICHA DE CARACTERIZACION: '.utf8_decode($this->mostrar($novedad->fk_id_ficha))),0,1,'L');
        $pdf->SetX(20);
        $pdf->cell(100,8,utf8_decode('PROGRAMA DE FORMACIÓN: '.$this->mostrar($novedad->programa_formacion)),0,1,'L');
        $pdf->SetX(20);
        $pdf->cell(150,8,'COMPETENCIA QUE CURSA: '.$this->mostrar($novedad->competencia),0,1,'L');
        $pdf->SetX(20);
        $pdf->cell(60,8,utf8_decode('TRIMESTRE QUE CURSA: '.$this->mostrar($novedad->trimestre_formacion)),0,0,'L');
        $pdf->SetXY(70,81);
        $pdf->cell(85,8,'FECHA REPORTE: '.$this->mostrar($novedad->fecha_inicio),0,1,'L');

        /* Muestra lo segundo */
        $pdf->SetX(20);
        $pdf->cell(100,8,utf8_decode('FECHA DE INICIACIÓN DEL CURSO:'),0,0,'L');

        /* Muestra el Dia */
        $pdf->SetFont('Arial','B',9);
        $pdf->setXY(110,89);
        $pdf->cell(10,5,'  ',1,0,'J');
        $pdf->cell(10,5,'  ',1,0,'J');
        $pdf->setXY(117,71);
        $pdf->cell(50,50,'DIA',0,0,'D');

        /* Muestra el Mes */
        $pdf->setXY(137,89);
        $pdf->cell(10,5,'  ',1,0,'J');
        $pdf->cell(10,5,'  ',1,0,'J');
        $pdf->setXY(143,71);
        $pdf->cell(50,50,'MES',0,0,'D');

        /* Muestra el Año */
        $pdf->setXY(165,89);
        $pdf->cell(10,5,'  ',1,0,'J');
        $pdf->cell(10,5,'  ',1,0,'J');
        $pdf->setXY(169,71);
        $pdf->cell(50,50,utf8_decode('AÑO'),0,1,'D');

        
        /* Muestra la parte superior del cuadro */

        $pdf->setXY(20,98);
        $pdf->cell(85,10,utf8_decode('DESERCIÓN'),1,0,'C');
        $pdf->cell(90,10,utf8_decode('POSIBLES CAUSAS DE DESERCION'),1,1,'C');
        $pdf->setXY(20,110);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(85,10,utf8_decode('FECHA DE DESERCION'),0,1,'C');


        /*Cuadoros pequeños*/

        $pdf->setXY(20,98);
        $pdf->Cell(85,65,utf8_decode(''),1,0,'C');


        /*Muestra lo que esta adentro del cuadro*/

        /* Muestra el Dia */
        $pdf->SetFont('Arial','B',12);
        $pdf->setXY(55,126);
        $pdf->cell(23,8,$this->mostrar($novedad->fecha_final    ),1,0,'C');
        $pdf->setXY(33,112);
        $pdf->cell(50,50,'',0,0,'D');


        /* Muestra la causa de desercion */

        $pdf->setXY(20,152);
        $pdf->SetFont('Arial','B',12);
        $pdf->cell(60,5,utf8_decode('CAUSA DE DESERCIÓN'),0,0,'C');
        $pdf->setXY(85,149);
        $pdf->cell(15,8,$this->mostrar($novedad->motivo),1,0,'C');

        /* Muestra la parte de la izquierda del cuadro */

        $pdf->setXY(105,108);
        $pdf->Cell(45,55,utf8_decode(''),1,0,'C');

        $pdf->SetFont('Arial','B',9);
        $pdf->setXY(105,108);
        $pdf->Cell(45,7,utf8_decode('1.Falta de interés en el curso.'),0,1,'',0);
        $pdf->setXY(105,114);
        $pdf->MultiCell(45,7,utf8_decode('2.Dedicación a otros estudios o actividades.'),0,1,'',0);
        $pdf->setXY(105,128);
        $pdf->Cell(45,7,utf8_decode('3.Problemas de salud.'),0,1,'',0);
        $pdf->setXY(105,135);
        $pdf->Cell(45,7,utf8_decode('4.Maternidad.'),0,1,'',0);
        $pdf->setXY(105,142);
        $pdf->MultiCell(45,5,utf8_decode('5.Problemas familiares o personales.'),0,1,'',0);
        $pdf->setXY(105,152);
        $pdf->Cell(45,5,utf8_decode('6.Problemas laborales.'),0,1,'',0);
        $pdf->setXY(105,157);
        $pdf->Cell(45,5,utf8_decode('7.Problemas económicos.'),0,1,'',0);

        /*Muestra la parte de la izquierda del cuadro N°2*/

        $pdf->setXY(150,108);
        $pdf->Cell(45,55,utf8_decode(''),1,0,'C');

        $pdf->setXY(150,108);
        $pdf->MultiCell(45,5,utf8_decode('8.Problema de servicio militar.'),0,1,'',0);
        $pdf->setXY(150,118);
        $pdf->MultiCell(45,5,utf8_decode('9.Problemas relacionados con el desarrollo del curso.'),0,1,'',0);
        $pdf->setXY(150,128);
        $pdf->MultiCell(45,5,utf8_decode('10.Bajo rendimiento académico y/o práctico.'),0,1,'',0);
        $pdf->setXY(150,138);
        $pdf->MultiCell(45,5,utf8_decode('11.Indisciplina y mala conducta.'),0,1,'',0);
        $pdf->setXY(150,148);
        $pdf->MultiCell(45,5,utf8_decode('12.Falta de puntualidad y mala conducta.'),0,1,'',0);
        $pdf->setXY(150,158);
        $pdf->MultiCell(45,4,utf8_decode('13.Otras causas.'),0,1,'',0);

        /* parte inferior del cuadro */

        $pdf->setXY(20,163);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(175,13,utf8_decode('OBSERVACIONES:  '.$this->mostrar($novedad->comentarios)),1,0,'l');


        /*Verificacion del reporte*/
        $pdf->setXY(20,180);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(175,13,utf8_decode('VERIFICACIÓN DEL REPORTE:'),0,0,'l');

        $pdf->setXY(80,180);
        $pdf->Cell(175,13,utf8_decode('Estado en Sofía:_________________'),0,1,'l');

        $pdf->setXY(20,185);
        $pdf->Cell(175,13,utf8_decode('Fecha verificación:'),0,1,'l');
        $pdf->setXY(56,185);
        $pdf->Cell(50,13,utf8_decode('D___/'),0,0,'l');
        $pdf->setXY(67,185);
        $pdf->Cell(50,13,utf8_decode('M___/'),0,0,'l');
        $pdf->setXY(77,185);
        $pdf->Cell(50,13,utf8_decode('A___'),0,0,'l');

        /* 	Muestra el segundo cuadro */
        /* 	Muestra la primera parte del cuadro */
        $pdf->setXY(20,195);
        $pdf->cell(45,8,utf8_decode('No. Telefónico'),1,0,'C');
        $pdf->setXY(65,195);
        $pdf->cell(68,8,utf8_decode('Dirección de Residencia'),1,0,'C');
        $pdf->setXY(133,195);
        $pdf->cell(61,8,utf8_decode('Correo Electrónico'),1,0,'C');

        /* 	Muestra la segunda parte del cuadro */
        /* 	Telefeno */
        $pdf->setXY(20,203);
        $pdf->cell(45,8,utf8_decode($this->mostrar($novedad->telefono)),1,0,'C');
        /* 	Direccion  */
        $pdf->setXY(65,203);
        $pdf->cell(68,8,utf8_decode($this->mostrar($novedad->direccion)),1,0,'C');
        /* 	Correo  */
        $pdf->setXY(133,203);
        $pdf->cell(61,8,utf8_decode($this->mostrar($novedad->correo)),1,0,'C');
        /* 	OBSERVACION  */
        $pdf->setXY(20,211);
        $pdf->Cell(174,14,utf8_decode('Observaciones:'),1,0,'L');
        /* 	Firma */
        $pdf->setXY(20,225);
        $pdf->Cell(174,10,utf8_decode('Firma del responsable:'),1,0,'L');
        $pdf->Ln();
        /* 	Firmas */
        $pdf->SetFont('Arial','B',10);
        $pdf->setXY(20,248);
        $pdf->Cell(60,10,utf8_decode('Nombre y firma instructor'),0,0,'C');
        $pdf->setXY(20,245);
        $pdf->Cell(50,8,utf8_decode('________________________________'),0,0,'L');

        /* 	Firma del instructor */
        $pdf->setXY(120,248);
        $pdf->Cell(60,10,utf8_decode('Nombre y firma instructor'),0,0,'C');
        $pdf->setXY(120,245);
        $pdf->Cell(50,8,utf8_decode('________________________________'),0,0,'L');

        /* 	Firma del vocero */
        $pdf->setXY(20,271);
        $pdf->Cell(60,5,utf8_decode('Nombre y firma vocero del Grupo'),0,0,'C');
        $pdf->setXY(20,266);
        $pdf->Cell(50,8,utf8_decode('________________________________'),0,0,'L');
        
        /* Firma del vocero */
        $pdf->setXY(120,271);
        $pdf->Cell(60,5,utf8_decode('Vo.Bo, Coordinador académico'),0,0,'C');
        $pdf->setXY(120,266);
        $pdf->Cell(120,8,utf8_decode('________________________________'),0,0,'L');



        $pdf->Output();
    }

    public function mostrar($dato)
    {
        $respuesta=ucwords(mb_strtolower($dato));
        return $respuesta;
    }	
}	

?>