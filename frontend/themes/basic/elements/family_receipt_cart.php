<table style="border-collapse: collapse; text-align: left;" border="0" width="100%" cellspacing="0" cellpadding="0" align="left">
    <tbody>
    <?php
    foreach( $order_items as $item ) {
        ?>
        <tr>
            <td class="textxxs"
                style="font-family: OpenSans, Arial, sans-serif; font-size: 15px; line-height: 25px; color: #000000; border-bottom: 1px solid #e0d9cb; font-weight: bold;"
                align="left" valign="middle"><?= $item->title ?>
            </td>
            <td class="textxxs"
                style="font-family: OpenSans, Arial, sans-serif; font-size: 15px; line-height: 25px; color: #000000; border-bottom: 1px solid #e0d9cb; font-weight: normal;"
                align="left" valign="middle">&nbsp;
            </td>
            <td class="textxxs"
                style="font-family: OpenSans, Arial, sans-serif; font-size: 15px; line-height: 25px; color: #000000; border-bottom: 1px solid #e0d9cb; font-weight: normal;"
                align="left" valign="middle"><?= $item->description ?>
            </td>

            <td class="textxxs"
                style="font-family: OpenSans, Arial, sans-serif; font-size: 15px; line-height: 25px; color: #532f48; border-bottom: 1px solid #e0d9cb; font-weight: bold;"
                align="right" valign="middle">$<?= $item->subtotal ?>
            </td>
        </tr>
    <?php
    }
    ?>
    <?php if($order->discount){ ?>
    <tr>
        <td class="textxxs" style="font-family: OpenSans, Arial, sans-serif; font-size: 15px; line-height: 35px;" align="left" valign="middle">&nbsp;</td>
        <td class="textxxs" style="font-family: OpenSans, Arial, sans-serif; font-size: 15px; line-height: 35px;" align="left" valign="middle">&nbsp;</td>
        <td class="textxxs" style="font-family: OpenSans, Arial, sans-serif; font-size: 15px; line-height: 35px; color: #000000; font-weight: normal;" align="left" valign="middle">Discount:</td>
        <td class="textxxs" style="font-family: OpenSans, Arial, sans-serif; font-size: 15px; line-height: 35px; color: #532f48; font-weight: bold;" align="right" valign="middle">$<?= $order->discount ?></td>
    </tr>
    <?php } ?>
    <tr>
        <td class="textxxs" style="font-family: OpenSans, Arial, sans-serif; font-size: 15px; line-height: 35px;" align="left" valign="middle">&nbsp;</td>
        <td class="textxxs" style="font-family: OpenSans, Arial, sans-serif; font-size: 15px; line-height: 35px;" align="left" valign="middle">&nbsp;</td>
        <td class="textxxs" style="font-family: OpenSans, Arial, sans-serif; font-size: 15px; line-height: 35px; color: #000000; font-weight: normal;" align="left" valign="middle">Total:</td>
        <td class="textxxs" style="font-family: OpenSans, Arial, sans-serif; font-size: 15px; line-height: 35px; color: #532f48; font-weight: bold;" align="right" valign="middle">$<?= $order->final_price ?></td>
    </tr>
    </tbody>
</table>