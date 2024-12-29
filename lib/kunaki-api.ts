import { XMLBuilder, XMLParser } from 'fast-xml-parser';

const KUNAKI_API_URL = 'https://Kunaki.com/XMLService.ASP';

type ShippingOption = {
  Description: string;
  DeliveryTime: string;
  Price: number;
};

type Product = {
  ProductId: string;
  Quantity: number;
};

type ShippingOptionsRequest = {
  Country: string;
  State_Province: string;
  PostalCode: string;
  Products: Product[];
};

type OrderRequest = {
  UserId: string;
  Password: string;
  Mode: 'Live' | 'TEST';
  Name: string;
  Company?: string;
  Address1: string;
  Address2?: string;
  City: string;
  State_Province: string;
  PostalCode: string;
  Country: string;
  ShippingDescription: string;
  Products: Product[];
};

type OrderStatusRequest = {
  UserId: string;
  Password: string;
  OrderId: string;
};

export async function getShippingOptions(request: ShippingOptionsRequest): Promise<ShippingOption[]> {
  const builder = new XMLBuilder({ format: true });
  const xmlRequest = builder.build({
    ShippingOptions: {
      Country: request.Country,
      State_Province: request.State_Province,
      PostalCode: request.PostalCode,
      Product: request.Products.map(p => ({
        ProductId: p.ProductId,
        Quantity: p.Quantity
      }))
    }
  });

  const response = await fetch(KUNAKI_API_URL, {
    method: 'POST',
    body: xmlRequest,
    headers: { 'Content-Type': 'application/xml' }
  });

  const xmlResponse = await response.text();
  const parser = new XMLParser();
  const result = parser.parse(xmlResponse);

  if (result.Response.ErrorCode !== '0') {
    throw new Error(`Kunaki API Error: ${result.Response.ErrorText}`);
  }

  return result.Response.Option;
}

export async function placeOrder(request: OrderRequest): Promise<string> {
  const builder = new XMLBuilder({ format: true });
  const xmlRequest = builder.build({
    Order: {
      UserId: request.UserId,
      Password: request.Password,
      Mode: request.Mode,
      Name: request.Name,
      Company: request.Company,
      Address1: request.Address1,
      Address2: request.Address2,
      City: request.City,
      State_Province: request.State_Province,
      PostalCode: request.PostalCode,
      Country: request.Country,
      ShippingDescription: request.ShippingDescription,
      Product: request.Products.map(p => ({
        ProductId: p.ProductId,
        Quantity: p.Quantity
      }))
    }
  });

  const response = await fetch(KUNAKI_API_URL, {
    method: 'POST',
    body: xmlRequest,
    headers: { 'Content-Type': 'application/xml' }
  });

  const xmlResponse = await response.text();
  const parser = new XMLParser();
  const result = parser.parse(xmlResponse);

  if (result.Response.ErrorCode !== '0') {
    throw new Error(`Kunaki API Error: ${result.Response.ErrorText}`);
  }

  return result.Response.OrderId;
}

export async function getOrderStatus(request: OrderStatusRequest): Promise<{
  OrderId: string;
  OrderStatus: string;
  TrackingType: string;
  TrackingId: string;
}> {
  const builder = new XMLBuilder({ format: true });
  const xmlRequest = builder.build({
    OrderStatus: {
      UserId: request.UserId,
      Password: request.Password,
      OrderId: request.OrderId
    }
  });

  const response = await fetch(KUNAKI_API_URL, {
    method: 'POST',
    body: xmlRequest,
    headers: { 'Content-Type': 'application/xml' }
  });

  const xmlResponse = await response.text();
  const parser = new XMLParser();
  const result = parser.parse(xmlResponse);

  if (result.Response.ErrorCode !== '0') {
    throw new Error(`Kunaki API Error: ${result.Response.ErrorText}`);
  }

  return {
    OrderId: result.Response.OrderId,
    OrderStatus: result.Response.OrderStatus,
    TrackingType: result.Response.TrackingType,
    TrackingId: result.Response.TrackingId
  };
}

export function getProductImageUrl(productId: string, view: 'front' | 'back' | 'f-spine' | 'b-spine' | 'left-inside' | 'right-inside' | 'box-shot'): string {
  const viewMap = {
    'front': 'FO',
    'back': 'BO',
    'f-spine': 'FS',
    'b-spine': 'BS',
    'left-inside': 'LI',
    'right-inside': 'RI',
    'box-shot': 'BX'
  };

  return `https://kunaki.com/ProductImage.ASP?T=I&ST=${viewMap[view]}&PID=${productId}`;
}

