<?php $totalServico = 0;
$totalProdutos = 0;?>
<div class="row-fluid" style="margin-top: 0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Ordem de Serviço</h5>
                <div class="buttons">
                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) {
                        echo '<a title="Icon Title" class="btn btn-mini btn-info" href="'.base_url().'index.php/os/editar/'.$result->idOs.'"><i class="icon-pencil icon-white"></i> Editar</a>';
} ?>
                    
                    <a target="_blank" title="Imprimir" class="btn btn-mini btn-inverse" href="<?php echo site_url()?>/os/imprimir/<?php echo $result->idOs; ?>"><i class="icon-print icon-white"></i> Imprimir</a>
                </div>
            </div>
            <div class="widget-content" id="printOs">
                <div class="invoice-content">
                    <div class="invoice-head" style="margin-bottom: 0">

                        <table class="table table-condensed" style="">
                        <tbody>
                            <?php if ($emitente == null) {?>
                                        
                            <tr>
                                <td colspan="3" class="alert">Você precisa configurar os dados do emitente. >>><a href="<?php echo base_url(); ?>index.php/mapos/emitente">Configurar</a><<<</td>
                            </tr>
                            <?php } else {?>
                            <tr>
                                <td style="width: 25%"><img src=" <?php echo $emitente[0]->url_logo; ?> " style="max-height: 100px"></td>
                                <td> <span style="font-size: 20px; "> <?php echo $emitente[0]->nome; ?></span> </br><span><?php echo $emitente[0]->cnpj; ?> </br> <?php echo $emitente[0]->rua.', '.$emitente[0]->numero.' - '.$emitente[0]->bairro.' - '.$emitente[0]->cidade.' - '.$emitente[0]->uf; ?> </span> </br> <span> E-mail: <?php echo $emitente[0]->email.' - Fone: '.$emitente[0]->telefone; ?></span></td>
                                <td style="width: 18%; text-align: center"><b>#PROTOCOLO:</b> <span ><?php echo $result->idOs?></span></br> </br> <span>Emissão: <?php echo date('d/m/Y')?></span></td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>

            
                    <table class="table table-condensend">
                        <tbody>
                            <tr>
                                <td style="width: 50%; padding-left: 0">
                                    <ul>
                                        <li>
                                            <span><h5><b>CLIENTE</b></h5>
                                            <span><?php echo $result->nomeCliente?></span><br/>
                                            <span><?php echo $result->rua?>, <?php echo $result->numero?>, <?php echo $result->bairro?></span>, 
                                            <span><?php echo $result->cidade?> - <?php echo $result->estado?></span><br>
                                            <span>E-mail: <?php echo $result->email?></span><br>
                                            <span>Celular: <?php echo $result->celular?></span>
                                        </li>
                                    </ul>
                                </td>
                                <td style="width: 50%; padding-left: 0">
                                    <ul>
                                        <li>
                                            <span><h5><b>RESPONSÁVEL</b></h5></span>
                                            <span><?php echo $result->nome?></span> <br/>
                                            <span>Telefone: <?php echo $result->telefone?></span><br/>
                                            <span>Email: <?php echo $result->email_responsavel ?></span>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
    
                </div>

                <div style="margin-top: 0; padding-top: 0">
                    

                    <table class="table table-condensed">
                        <tbody>
                            
                            <?php if($result->dataInicial != null){?>
                            <tr>
                                <td>
                                <b>DATA INICIAL: </b>
                                <?php echo date('d/m/Y', strtotime($result->dataInicial)); ?>
                                </td>

                                <td>
                                <b>DATA FINAL: </b>
                                <?php echo $result->dataFinal ? date('d/m/Y', strtotime($result->dataFinal)) : ''; ?>
                                </td>

                                <td>
                                <b>GARANTIA: </b>
                                <?php echo $result->garantia; ?>
                                </td>

                            </tr>
                            <?php }?>

                            <?php if($result->descricaoProduto != null){?>
                            <tr>
                                <td colspan="3">
                                <b>DESCRIÇÃO: </b>
                                <?php echo $result->descricaoProduto ?>
                                </td>
                            </tr>
                            <?php }?>
                            

                            <?php if($result->defeito != null){?>
                            <tr>
                                <td colspan="3">
                                <b>DEFEITO APRESENTADO: </b>
                                <?php echo $result->defeito?>
                                </td>
                            </tr>
                            <?php }?>
                            
                            <?php if($result->observacoes != null){?>
                            <tr>
                                <td colspan="3">
                                <b>OBSERVAÇÕES: </b>
                                <?php echo $result->observacoes?>
                                </td>
                            </tr>
                            <?php }?>

                            <?php if($result->laudoTecnico != null){?>
                            <tr>
                                <td colspan="3">
                                <b>LAUDO TÉCNICO: </b>
                                <?php echo $result->laudoTecnico?>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    
                    <?php if ($produtos != null) {?>
                        <br />
                        <table class="table table-bordered table-condensed" id="tblProdutos">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th>Sub-total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        foreach ($produtos as $p) {

                                            $totalProdutos = $totalProdutos + $p->subTotal;
                                            echo '<tr>';
                                            echo '<td>'.$p->descricao.'</td>';
                                            echo '<td>'.$p->quantidade.'</td>';
                                            
                                            echo '<td>R$ '.number_format($p->subTotal, 2, ',', '.').'</td>';
                                            echo '</tr>';
                                        }?>

                                        <tr>
                                            <td colspan="2" style="text-align: right"><strong>Total:</strong></td>
                                            <td><strong>R$ <?php echo number_format($totalProdutos, 2, ',', '.');?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php }?>
                        
                                <?php if ($servicos != null) {?>
                            <table class="table table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Serviço</th>
                                            <th>Sub-total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        setlocale(LC_MONETARY, 'en_US');
                                        foreach ($servicos as $s) {
                                            $preco = $s->preco;
                                            $totalServico = $totalServico + $preco;
                                            echo '<tr>';
                                            echo '<td>'.$s->nome.'</td>';
                                            echo '<td>R$ '.number_format($s->preco, 2, ',', '.').'</td>';
                                            echo '</tr>';
                                        }?>

                                        <tr>
                                            <td colspan="1" style="text-align: right"><strong>Total:</strong></td>
                                            <td><strong>R$ <?php  echo number_format($totalServico, 2, ',', '.');?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                        <?php }?>
                        <h4 style="text-align: right">Valor Total: R$ <?php echo number_format($totalProdutos + $totalServico, 2, ',', '.');?></h4>

                    </div>
            

                    
                    
              
                </div>
            </div>
        </div>
    </div>
</div>
