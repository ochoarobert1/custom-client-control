<?php get_header(); ?>
<?php if (is_user_logged_in()) { ?>
<?php if (current_user_can('manage_options')) {?>
<?php the_post(); ?>
<div class="ccc-screen-container">
    <button class="btn btn-md btn-success btn-print">Imprimir Presupuesto</button>
</div>
<div class="ccc-main-container ccc-first-page">
    <div class="page-middle-inner">
        <img src="<?php echo plugins_url('/logo-white.png', __FILE__);?>" alt="" class="img-center img-logo">
        <div class="main-title">
            <h1>Presupuesto Web</h1>
            <h5>Julio 2019</h5>
        </div>
    </div>
</div>
<div class="ccc-main-container ccc-second-page">
    <div class="page-inner">
        <div class="section-0">
            <p>PRESUPUESTO <strong>WEB</strong> <img src="<?php echo plugins_url('/logo.png', __FILE__);?>" alt="" class="img-title" /></p>
        </div>
        <div class="section-1">
            <div><img src="<?php echo plugins_url('/001-conversation.png', __FILE__);?>" alt="" class="img-center"></div>
            <div>
                <p>La capacidad de respuesta a las necesidades del mercado viene determinada por la adecuación y accesibilidad de la comunicación de la empresa.</p>
            </div>
        </div>
        <div class="section-2">
            <div><img src="<?php echo plugins_url('/002-stopwatch.png', __FILE__);?>" alt="" class="img-center"></div>
            <div>
                <h2>¡Las Oportunidades no esperan!</h2>
                <p>Estar siempre disponible en cualquier lugar con el contenido adecuado siempre es el modelo a seguir. Comunicar la filosofía de la empresa, valores, posicionamiento y productos requiere cada vez más de herramientas flexibles, donde el contenido se adapte a los intereses del Mercado, oportunidades de negocio y, sobre todo, a las necesidades del cliente.</p>
            </div>
        </div>
        <div class="section-3">
            <p>Esta capacidad de adecuación no serviría de nada sin herramientas que posibilitan un control sobre el contenido, emitido de forma centralizada y “viva”. Poder controlar y actualizar en cualquier momento y desde cualquier lugar el contenido que estamosofreciendo es clave para mantener la información actualizada al minuto, dando respuesta a posibles oportunidades, acciones de la competencia, ferias, eventos.</p>
        </div>
        <div class="section-4">
            <h2>Una versión única del contenido actualizable en cualquier momento desde cualquier lugar.</h2>
        </div>
        <div class="section-5">
            <p>Por último, la capacidad de recoger datos sobre las preferencias de los visitantes
                permitirá conocer mejor que tipo de productos son los preferidos y más consultados, cuales generan más visitas desde buscadores, que países nos están visitando, etc. Esta ventaja natural de internet se convierte en una herramienta de mucho valor si el diseño de la web facilita la recogida e interpretación de estos datos.</p>
        </div>
        <div class="section-6">
            <div><img src="<?php echo plugins_url('/003-startup.png', __FILE__);?>" alt="" class="img-center"></div>
            <div>
                <p>Conocer las preferencias reales de los usuarios</p>
                <p>+ Capacidad de adaptar el contenido</p>
                <p>= Mayor sintonía entre mensaje y espectador.</p>
            </div>
        </div>
    </div>
</div>
<div class="ccc-main-container ccc-third-page">
    <div class="page-inner">
        <div class="section-0">
            <p>PRESUPUESTO <strong>WEB</strong> <img src="<?php echo plugins_url('/logo.png', __FILE__);?>" alt="" class="img-title" /></p>
        </div>
        <div class="section-1">
            <h2><strong>Datos</strong> del Proyecto</h2>
            <div><img src="<?php echo plugins_url('/icon-avatar.png', __FILE__); ?>" alt="" class="img-inline" /> <strong>Nombre del Cliente:</strong> <?php echo get_post_meta(get_the_ID(), 'ccc_nombre_cliente', true); ?></div>
            <div><img src="<?php echo plugins_url('/icon-data.png', __FILE__); ?>" alt="" class="img-inline" /> <strong>Tipo de Proyecto:</strong> <?php the_title(); ?></div>
            <div><img src="<?php echo plugins_url('/icon-calendar.png', __FILE__); ?>" alt="" class="img-inline" /> <strong>Fecha del Presupuesto:</strong> <?php echo date('d-m-Y'); ?></div>
        </div>
        <div class="section-2">
            <div>
                <h2><strong>Desarrollo</strong> del Proyecto</h2>
                <br />
                <?php the_content(); ?>
            </div>
            <div>
                <img src="<?php echo plugins_url('/004-website.png', __FILE__);?>" alt="" class="img-center">
            </div>
        </div>
        <div class="section-3">
            <h2>Te ofrezco lo siguiente:</h2>
            <?php $elementos = get_post_meta(get_the_ID(), 'ccc_offers', true); ?>
            <ul>
                <?php foreach ($elementos as $item) { ?>
                <li><?php echo $item; ?></li>
                <?php } ?>
            </ul>
            <h4><strong>Y por último pero no menos importante:</strong> estoy entregándote un sitio con un diseño que se mantendrá actualizado que tendrá todas las cualidades necesarias para que tu marca / empresa tenga una grandiosa presencia en la Internet.</h4>
        </div>
    </div>
</div>
<div class="ccc-main-container ccc-fourth-page">
    <div class="page-inner">
        <div class="section-0">
            <p>PRESUPUESTO <strong>WEB</strong> <img src="<?php echo plugins_url('/logo.png', __FILE__);?>" alt="" class="img-title" /></p>
        </div>
        <div class="section-1">
            <h2><strong>Costo</strong> del Proyecto</h2>
            <?php $currency = get_post_meta(get_the_ID(), 'ccc_currency', true); ?>
            <?php if ($currency != 2) { ?>
            <?php if ($currency === 0) { $currency_text = 'Bolívares.'; $currency_symbol = 'Bs.'; } else { $currency_text = 'Dólares.'; $currency_symbol = '$'; }?>
            <h4>(Valuado en <?php echo $currency_text; ?>)</h4>
            <div>
                <table>
                    <tr>
                        <th>Etapa</th>
                        <th>Descripción</th>
                        <th>Costo</th>
                    </tr>

                    <?php $elementos = get_post_meta(get_the_ID(), 'ccc_elementos', true); ?>
                    <?php $i = 1; ?>
                    <?php foreach ($elementos as $item) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $item; ?></td>
                        <td></td>
                    </tr>
                    <?php $i++; } ?>
                    <tr>
                        <td colspan=2>TOTAL</td>
                        <td><?php echo $currency_symbol; ?> <?php echo number_format(get_post_meta(get_the_ID(), 'ccc_precio_dolares', true), 2, ',', '.' ); ?></td>
                    </tr>
                </table>
            </div>
            <?php } else { ?>
            <?php $currency_text = 'Bolívares.'; $currency_symbol = 'Bs.'; ?>
            <h4>(Valuado en <?php echo $currency_text; ?>)</h4>
            <div>
                <table>
                    <tr>
                        <th>Etapa</th>
                        <th>Descripción</th>
                        <th>Costo</th>
                    </tr>

                    <?php $elementos = get_post_meta(get_the_ID(), 'ccc_elementos', true); ?>
                    <?php $i = 1; ?>
                    <?php foreach ($elementos as $item) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $item; ?></td>
                        <td></td>
                    </tr>
                    <?php $i++; } ?>
                    <tr>
                        <td colspan=2>TOTAL</td>
                        <td><?php echo $currency_symbol; ?> <?php echo number_format(get_post_meta(get_the_ID(), 'ccc_precio_bolivares', true), 2, ',', '.' ); ?></td>
                    </tr>
                </table>
            </div>
            <?php $currency_text = 'Dólares.'; $currency_symbol = '$ '; ?>
            <h4>(Valuado en <?php echo $currency_text; ?>)</h4>
            <div>
                <table>
                    <tr>
                        <th>Etapa</th>
                        <th>Descripción</th>
                        <th>Costo</th>
                    </tr>

                    <?php $elementos = get_post_meta(get_the_ID(), 'ccc_elementos', true); ?>
                    <?php $i = 1; ?>
                    <?php foreach ($elementos as $item) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $item; ?></td>
                        <td></td>
                    </tr>
                    <?php $i++; } ?>
                    <tr>
                        <td colspan=2>TOTAL</td>
                        <td><?php echo $currency_symbol; ?> <?php echo number_format(get_post_meta(get_the_ID(), 'ccc_precio_dolares', true), 2, ',', '.' ); ?></td>
                    </tr>
                </table>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="ccc-main-container ccc-fifth-page">
    <div class="page-inner">
        <div class="section-0">
            <p>PRESUPUESTO <strong>WEB</strong> <img src="<?php echo plugins_url('/logo.png', __FILE__);?>" alt="" class="img-title" /></p>
        </div>
        <div class="section-1">
            <h2><strong>Condiciones</strong> del Proyecto</h2>
            <p>El tiempo de entrega para el proyecto es de <strong><?php echo get_post_meta(get_the_ID(), 'ccc_tiempo_entrega', true); ?></strong>, y comienzan a contar desde la entrega de los accesos necesarios para llevar a cabo la propuesta, (en caso de tenerlos, hosting, ftp, entre otros) y demás información relevante.</p>
            <p>La información y los accesos deben ser enviados con la confirmación de la cancelación del 50% inicial y la firma de este documento en señal de aceptación de las condiciones.</p>
            <p>El pago (si es en Bolívares) se hará en dos (2) partes: 50% adelantado, con la entrega firmada de este documento en señal de aceptación formal de la propuesta y las condiciones que en él se establecen. El 50% restante se cancelara al momento de la entrega final.</p>
            <p>El Pago (si es en dólares) se hará al finalizar el proyecto. El cliente asumirá la comisión de PayPal.</p>
            <p>Una vez cancelada la segunda parte, se hará entrega formal en un documento de todos los accesos, usuarios, claves y contraseñas que se hayan generado durante el proyecto.</p>
            <p>El Cliente asumirá cualquier responsabilidad en cuanto a los retrasos generados para la aprobación de artes, Wireframes o cambios en la programación y demás estructuras que requieran de su revisión.</p>
            <p>Si el cliente declina a medio trabajo de continuar la relación de trabajo y ha tomado la opción de pago en Bolívares, el pago por haber iniciado el trabajo no será devuelto, se tomará como parte del trabajo que ya empezó a realizarse.</p>
            <p>Si el cliente declina a medio trabajo de continuar la relación de trabajo y había decidido tomar la opción de pago en dólares, será sujeto a penalización y deberá pagar el 25% de lo acordado vía PayPal por el trabajo que ya empezó a realizarse.</p>
            <p>Si el cliente declina de continuar la relación de trabajo antes de la fecha acordada, el contenido desarrollado y el código será removido del servidor de prueba y no podrá ser usada la interfaz que se ha desarrollado.</p>
            <p>El proyecto estará considerado a ser expuesto en la página de Robert Ochoa, como parte de su portafolio y casos de éxito (teniendo en cuenta la data sensible que el cliente pueda tener en su página web).</p>
            <p>El código del proyecto estará considerado a ser expuesto en los perfiles de trabajo de Robert Ochoa (entiéndase perfiles de trabajo como Github / Linkedin / Behance y otros sitios de resentación de trabajos), los cuales el proyecto aplique.</p>
        </div>
    </div>
</div>
<?php } ?>
<?php } ?>
<?php get_footer(); ?>
