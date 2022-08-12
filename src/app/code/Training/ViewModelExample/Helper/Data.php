<?php

namespace Training\ViewModelExample\Helper;

use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Quote\Api\CartItemRepositoryInterface;
use Magento\Quote\Api\CartManagementInterface;
use Magento\Quote\Model\Quote;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Framework\DataObject;
use Magento\Checkout\Model\Cart;


class Data extends AbstractHelper
{
    private CartManagementInterface $cartManager;
    private CartRepositoryInterface $cartRepository;
    private Product $product;
    private ProductFactory $productFactory;
    private CartItemRepositoryInterface $cartItemRepository;
    private DataObject $dataObject;
    private Cart $cart;

    public function __construct(
        Context $context,
        CartManagementInterface $cartManager,
        CartRepositoryInterface $cartRepository,
        Product $product,
        ProductFactory $productFactory,
        CartItemRepositoryInterface $cartItemRepository,
        DataObject $dataObject,
        Cart $cart
    ) {
        parent::__construct($context);
        $this->cartManager = $cartManager;
        $this->cartRepository = $cartRepository;
        $this->product = $product;
        $this->productFactory = $productFactory;
        $this->cartItemRepository = $cartItemRepository;
        $this->dataObject = $dataObject;
        $this->cart = $cart;
    }


    /**
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function createEmptyQuoteForCustomer(CustomerInterface $customer, int $storeId): CartInterface
    {
        $cartId = $this->cartManager->createEmptyCart();
        $quote = $this->cartRepository->get($cartId);
        $quote->setStoreId($storeId);
        $quote->setCurrency();
        $quote->setCustomer($customer);
        $this->cartRepository->save($quote);
        return $quote;
    }

    /**
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\InputException
     */
    public function addItemToQuote(Quote $quote, array $productInfo)
    {
        $product = $this->productFactory->create();
        $this->product->load($product, $productInfo['product_id']);
        $this->dataObject = $this->dataObject->setData($productInfo);
        $item = $quote->addProduct($product, $this->dataObject);
        $this->cartItemRepository->save($item);
    }

    public function applyCouponOnCart(Quote $quote, $couponCode)
    {
        $this->cart->setQuote($quote);
        $quote = $this->cart->getQuote();
        $quote->setCouponCode($couponCode);
        $quote->collectTotals();
        // $this->cartRepository->save($quote);
    }
}
