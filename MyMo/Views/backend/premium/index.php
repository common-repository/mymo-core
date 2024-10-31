<div class="wrap">
    <div id="icon-users" class="icon32"></div>
    <div class="col-container">
        <div class="mymo-comparison">
            <table>
                <thead>
                <tr>
                    <th class="tl tl2"></th>
                    <th class="qbse">
                        For Basic
                    </th>
                    <th class="qbo" colspan="2">
                        For Pro
                    </th>
                </tr>
                <tr>
                    <th class="tl"></th>
                    <th class="compare-heading">
                        Pree
                    </th>
                    <th class="compare-heading" colspan="2">
                        Premium
                    </th>
                </tr>
                <tr>
                    <th></th>
                    <th class="price-info">
                        <!--<div class="price-was">Was £6.00</div>-->
                        <div class="price-now"><span>$0<span class="price-small">.00</span></span> /year</div>
                        
                        <!--<div class="price-try"><span class="hide-mobile">or </span><a href="#">try
                                <span class="hide-mobile">it free</span></a>
                        </div>-->
                    </th>
                    <th class="price-info" colspan="2">
                        <!--<div class="price-was">Was £7.00</div>-->
                        <div class="price-now"><span>$59<span class="price-small">.99</span></span> /year</div>
                        <div><a href="https://www.facebook.com/106246807865039/" target="_blank" class="price-buy">Buy <span class="hide-mobile">Now</span></a></div>
                        <!--<div class="price-try"><span class="hide-mobile">or </span><a href="#">try
                                <span class="hide-mobile">it free</span></a>
                        </div>-->
                    </th>
                </tr>
                </thead>
                <tbody>
                
                <?php foreach ($features as $name => $feature) : ?>
                    <tr>
                        <td></td>
                        <td colspan="3"></td>
                    </tr>
                    
                    <tr class="compare-row">
                        <td><div class="<?php echo (empty($feature[0]) && $feature[1]) ? 'qcheck' : 'qnone' ?>"><?php echo $name ?></div></td>
                        <td><span class="tickgreen"><?php echo $feature[0] == 1 ? '&#10004;': '&#10006;' ?></span></td>
                        <td colspan="2"><span class="tickgreen"><?php echo $feature[1] == 1 ? '&#10004;': '&#10006;' ?></span></td>
                    </tr>

                <?php endforeach; ?>
                
                </tbody>
            </table>
        </div>
    </div>
</div>