import { Component } from '@angular/core';

import { GalleryItem, GalleryItemType } from '../../shared/gallery/gallery-item.interface';

@Component({
  selector: 'kizomba-dance',
  templateUrl: './kizomba-dance.component.html',
  styleUrls: ['./kizomba-dance.component.css']
})
export class KizombaDanceComponent {

	public kizombaVideos: Array<GalleryItem> = [
		{
			itemType: GalleryItemType.video,
			url: "8uNx-Yh1Mus",
			title: "Kizomba",
			description: "Giedre & João"
		},
		{
			itemType: GalleryItemType.video,
			url: "RZcbZ2-Gn10",
			title: "Kizomba",
			description: "###"
		}
	];
	
	public sembaVideos: Array<GalleryItem> = [
		{
			itemType: GalleryItemType.video,
			url: "7Up9QHPUVW0",
			title: "Semba",
			description: "Bonifácio Áurio"
		},
		{
			itemType: GalleryItemType.video,
			url: "i6-RJsQfIEw",
			title: "Semba",
			description: "???"
		},
		{
			itemType: GalleryItemType.video,
			url: "-5s_jfnYWtg",
			title: "Semba",
			description: "!!!"
		}
	];

	public tarraxinhaVideos: Array<GalleryItem> = [
		{
			itemType: GalleryItemType.video,
			url: "NtEZ8a39u48",
			title: "Tarraxinha",
			description: "$$$"
		},
		{
			itemType: GalleryItemType.video,
			url: "HuQfuutKlzE",
			title: "Tarraxinha",
			description: "%%%"
		}
	];
	
  constructor() {
		
  }
}
