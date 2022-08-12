<?php

namespace Training\ViewModelExample\Test\Unit\Helper;

use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product;
use Magento\Quote\Api\CartItemRepositoryInterface;
use Magento\Quote\Api\CartManagementInterface;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Api\Data\CartItemInterface;
use PHPUnit\Framework\TestCase;
use Training\ViewModelExample\Helper\Data;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Quote\Model\Quote;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Framework\DataObject;
use Magento\Checkout\Model\Cart;

class DataTest extends TestCase
{

    private CartManagementInterface $cartManager;
    private CartInterface $quote;
    private CartRepositoryInterface $cartRepository;
    private Product $product;
    private ProductFactory $productFactory;
    private CartItemRepositoryInterface $cartItemRepository;
    private DataObject $dataObject;
    private Cart $cart;
    private Data $object;

    protected function setUp(): void
    {
        parent::setUp();


        $context = $this->createMock(Context::class);
        $this->cartManager = $this->createMock(CartManagementInterface::class);

        $this->cartRepository = $this->createMock(CartRepositoryInterface::class);

        $this->product = $this->createMock(Product::class);
        $this->productFactory = $this->createMock(ProductFactory::class);
        $this->cartItemRepository = $this->createMock(CartItemRepositoryInterface::class);
        $this->dataObject = $this->createMock(DataObject::class);
        $this->cart = $this->createMock(Cart::class);

        $this->object = new Data(
            $context,
            $this->cartManager,
            $this->cartRepository,
            $this->product,
            $this->productFactory,
            $this->cartItemRepository,
            $this->dataObject,
            $this->cart
        );
    }

    public function testCreateEmptyQuoteForCustomer()
    {
        $quote = $this->createMock(Quote::class);
        $customer = $this->createMock(CustomerInterface::class);
        $this->cartManager->expects($this->once())->method('createEmptyCart')->willReturn(1);
        $this->cartRepository->expects($this->once())->method('get')->with(1)->willReturn($quote);
        $quote->expects($this->once())->method('setStoreId')->with(19)->willReturn($quote);
        $quote->expects($this->once())->method('setCurrency')->willReturn($quote);
        $quote->expects($this->once())->method('setCustomer')->with($customer)->willReturn($quote);
        $this->cartRepository->expects($this->once())->method('save')->with($quote);

        $result = $this->object->createEmptyQuoteForCustomer($customer, 19);

        $this->assertInstanceOf(CartInterface::class, $result);
    }

    public function testAddItemToQuote()
    {
        $quote = $this->createMock(Quote::class);
        $productModel = $this->createMock(\Magento\Catalog\Model\Product::class);

        $this->productFactory->expects($this->once())
            ->method('create')
            ->willReturn($productModel);

        $this->product->expects($this->once())
            ->method('load')
            ->withConsecutive([$productModel, 1])
            ->willReturn($this->product);

        $item = $this->createMock(CartItemInterface::class);
        $this->dataObject->expects($this->once())->method('setData')
            ->with([
                'product_id' => 1,
                'related_product' => null,
                'qty' => 2
            ])->willReturn($this->dataObject);
        $quote->expects($this->once())->method('addProduct')
            ->withConsecutive([$productModel, $this->dataObject])->willReturn($item);

        $this->cartItemRepository->expects($this->once())->method('save')->with($item);

        $this->object->addItemToQuote(
            $quote,
            [
                'product_id' => 1,
                'related_product' => null,
                'qty' => 2
            ]
        );
    }

    public function testApplyCouponOnCart()
    {

        $this->quote = $this->getMockBuilder(Quote::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->addMethods(['setCouponCode'])
            ->onlyMethods(['collectTotals'])
            ->getMock();

        $this->cart->expects($this->once())
            ->method('setQuote')
            ->with($this->quote);
        $this->cart->expects($this->once())
            ->method('getQuote')
            ->willReturn($this->quote);

        $this->quote->expects($this->once())
            ->method('setCouponCode')
            ->with('xyz');
        $this->quote->expects($this->once())
            ->method('collectTotals');
        $this->cartRepository->expects($this->once())
            ->method('save')
            ->with($this->quote);

        $this->object->applyCouponOnCart(
            $this->quote,
            'xyz'
        );
    }
}
